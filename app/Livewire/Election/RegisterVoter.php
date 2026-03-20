<?php

namespace App\Livewire\Election;

use App\Models\Election;
use App\Models\PotentialVoter;
use App\Services\SmsService;
use Livewire\Component;

class RegisterVoter extends Component
{
    public $election;
    public $title = '';
    public $full_name = '';
    public $email = '';
    public $mobile = '';
    public $registered = false;

    public function mount($uuid)
    {
        $this->election = Election::where('uuid', $uuid)->firstOrFail();
        
        // Check if self-registration is blocked
        if (\App\Models\Setting::get('block_self_registration', false)) {
            abort(403, 'Self-registration is currently disabled. Please contact the administrator.');
        }
    }

    public function register()
    {
        $validated = $this->validate([
            'title' => 'required|string|max:20',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mobile' => 'required|string|max:20',
        ]);

        $validated['election_id'] = $this->election->id;
        $voter = PotentialVoter::create($validated);

        // Send SMS feedback to voter
        $smsService = new SmsService();
        $message = "Dear {$voter->title} {$voter->full_name}, your voter registration for {$this->election->name} has been completed successfully. You will receive further updates via SMS. Thank you for registering!";
        $smsService->send($voter->mobile, $message);

        // Send alert to admin if enabled
        $alertEnabled = \App\Models\Setting::get('voter_alert_enabled', false);
        $alertPhone = \App\Models\Setting::get('voter_alert_phone');
        
        if ($alertEnabled && $alertPhone) {
            $alertMessage = "New voter registered: {$voter->full_name} ({$voter->mobile}) for {$this->election->name}";
            $smsService->send($alertPhone, $alertMessage);
        }

        $this->registered = true;
        $this->reset(['title', 'full_name', 'email', 'mobile']);
    }

    public function render()
    {
        return view('livewire.election.register-voter')->layout('layouts.welcome');
    }
}
