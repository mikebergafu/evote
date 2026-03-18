<?php

namespace App\Livewire\Election;

use App\Models\Voter;
use Livewire\Component;

class GetVotingLink extends Component
{
    public $phone = '';
    public $votingLink = null;
    public $voterName = null;

    public function getLink()
    {
        $this->validate(['phone' => 'required|string']);

        $voter = Voter::where('phone', $this->phone)->first();

        if (!$voter) {
            $this->addError('phone', 'Phone number not found in any election.');
            return;
        }

        $this->voterName = $voter->name;
        $this->votingLink = route('election.vote', $voter->election_id);
    }

    public function render()
    {
        return view('livewire.election.get-voting-link')->layout('layouts.welcome');
    }
}
