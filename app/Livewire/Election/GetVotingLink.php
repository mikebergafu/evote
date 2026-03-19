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

        $election = $voter->election;
        
        // Check if voting has started
        if (now()->isBefore($election->starts_at)) {
            $this->addError('phone', 'Voting has not started yet. Voting starts on ' . $election->starts_at->format('M d, Y H:i'));
            return;
        }
        
        // Check if voting has ended
        if (now()->isAfter($election->ends_at)) {
            $this->addError('phone', 'Voting has ended. Voting ended on ' . $election->ends_at->format('M d, Y H:i'));
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
