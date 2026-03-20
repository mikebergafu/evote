<?php

namespace Tests\Feature\Election;

use App\Models\Election;
use App\Models\User;
use App\Models\Position;
use App\Models\Candidate;
use App\Models\Voter;
use App\Models\Vote;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ElectionReportTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_download_election_report()
    {
        $user = User::factory()->create();
        
        $election = Election::create([
            'name' => 'Test Election',
            'description' => 'Test Description',
            'starts_at' => now()->subDay(),
            'ends_at' => now()->addDay(),
            'status' => 'active',
        ]);

        $position = Position::create([
            'election_id' => $election->id,
            'title' => 'President',
            'description' => 'Presidential position',
            'order' => 1,
        ]);

        $candidate = Candidate::create([
            'election_id' => $election->id,
            'position_id' => $position->id,
            'name' => 'John Doe',
            'bio' => 'Test bio',
            'position' => 1,
        ]);

        $voter = Voter::create([
            'election_id' => $election->id,
            'voter_id' => 'TEST123',
            'name' => 'Test Voter',
            'has_voted' => true,
            'voted_at' => now(),
        ]);

        Vote::create([
            'election_id' => $election->id,
            'voter_id' => $voter->id,
            'candidate_id' => $candidate->id,
            'position' => 'President',
            'vote_hash' => hash('sha256', $voter->id . $candidate->id . now()),
        ]);

        $response = $this->actingAs($user)
            ->get(route('election.report', $election));

        $response->assertStatus(200);
        $response->assertHeader('content-type', 'application/pdf');
    }

    public function test_guest_cannot_download_election_report()
    {
        $election = Election::create([
            'name' => 'Test Election',
            'description' => 'Test Description',
            'starts_at' => now()->subDay(),
            'ends_at' => now()->addDay(),
            'status' => 'active',
        ]);

        $response = $this->get(route('election.report', $election));

        $response->assertRedirect(route('login'));
    }
}
