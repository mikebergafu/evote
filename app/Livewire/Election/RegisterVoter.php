<?php

namespace App\Livewire\Election;

use App\Models\PotentialVoter;
use App\Services\SmsService;
use Livewire\Component;

class RegisterVoter extends Component
{
    public $title = '';
    public $full_name = '';
    public $email = '';
    public $mobile = '';
    public $registered = false;

    public function register()
    {
        $validated = $this->validate([
            'title' => 'required|string|max:20',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mobile' => 'required|string|max:20',
        ]);

        $voter = PotentialVoter::create($validated);

        // Send SMS feedback
        $smsService = new SmsService();
        $message = "Dear {$voter->title} {$voter->full_name}, your voter registration has been completed successfully. You will receive further updates via SMS. Thank you for registering!";
        $smsService->send($voter->mobile, $message);

        $this->registered = true;
        $this->reset(['title', 'full_name', 'email', 'mobile']);
    }

    public function render()
    {
        return view('livewire.election.register-voter')->layout('layouts.welcome');
    }
}
