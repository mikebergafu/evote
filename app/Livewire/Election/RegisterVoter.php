<?php

namespace App\Livewire\Election;

use App\Models\PotentialVoter;
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

        PotentialVoter::create($validated);

        $this->registered = true;
        $this->reset(['title', 'full_name', 'email', 'mobile']);
    }

    public function render()
    {
        return view('livewire.election.register-voter')->layout('layouts.welcome');
    }
}
