<?php

namespace Tests\Feature\Election;

use App\Livewire\Election\RegisterVoter;
use App\Models\Election;
use App\Models\Setting;
use App\Services\SmsService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class VoterSelfRegistrationBlockTest extends TestCase
{
    use RefreshDatabase;

    public function test_voter_self_registration_still_works_when_user_registration_block_setting_is_enabled(): void
    {
        $election = Election::create([
            'name' => 'Test Election',
            'description' => 'Test',
            'starts_at' => now()->subDay(),
            'ends_at' => now()->addDay(),
            'status' => 'active',
        ]);

        Setting::set('block_self_registration', true);

        $sms = new class extends SmsService {
            public int $sent = 0;

            public function send(string $phone, string $message, string $sender = null): bool
            {
                $this->sent++;

                return true;
            }
        };

        $this->app->instance(SmsService::class, $sms);

        Livewire::test(RegisterVoter::class, ['uuid' => $election->uuid])
            ->set('title', 'Mr')
            ->set('full_name', 'Blocked Voter')
            ->set('email', 'blocked@example.com')
            ->set('mobile', '+233200000001')
            ->call('register')
            ->assertSet('registered', true)
            ->assertHasNoErrors();

        $this->assertDatabaseHas('potential_voters', [
            'election_id' => $election->id,
            'full_name' => 'Blocked Voter',
            'email' => 'blocked@example.com',
        ]);
        $this->assertSame(1, $sms->sent);
    }

    public function test_user_account_registration_is_blocked_when_setting_is_enabled(): void
    {
        Setting::set('block_self_registration', true);

        $response = $this->post(route('register.store'), [
            'name' => 'Normal User',
            'email' => 'normal.user@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertSessionHasErrors('email');

        $this->assertGuest();
    }

    public function test_user_account_registration_works_when_setting_is_disabled(): void
    {
        Setting::set('block_self_registration', false);

        $response = $this->post(route('register.store'), [
            'name' => 'Allowed User',
            'email' => 'allowed.user@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertSessionHasNoErrors()
            ->assertRedirect(route('dashboard', absolute: false));

        $this->assertAuthenticated();
    }

    public function test_voter_self_registration_creates_record_when_setting_is_disabled(): void
    {
        $election = Election::create([
            'name' => 'Open Election',
            'description' => 'Test',
            'starts_at' => now()->subDay(),
            'ends_at' => now()->addDay(),
            'status' => 'active',
        ]);

        Setting::set('block_self_registration', false);
        Setting::set('voter_alert_enabled', false);

        $sms = new class extends SmsService {
            public int $sent = 0;

            public function send(string $phone, string $message, string $sender = null): bool
            {
                $this->sent++;

                return true;
            }
        };

        $this->app->instance(SmsService::class, $sms);

        Livewire::test(RegisterVoter::class, ['uuid' => $election->uuid])
            ->set('title', 'Ms')
            ->set('full_name', 'Open Voter')
            ->set('email', 'open@example.com')
            ->set('mobile', '+233200000002')
            ->call('register')
            ->assertSet('registered', true)
            ->assertHasNoErrors();

        $this->assertDatabaseHas('potential_voters', [
            'election_id' => $election->id,
            'full_name' => 'Open Voter',
            'email' => 'open@example.com',
        ]);

        $this->assertSame(1, $sms->sent);
    }
}
