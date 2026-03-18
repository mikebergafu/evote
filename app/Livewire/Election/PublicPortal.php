<?php

namespace App\Livewire\Election;

use App\Models\Election;
use App\Models\Voter;
use Livewire\Component;

class PublicPortal extends Component
{
    public $voterId = '';
    public $voter = null;
    public $elections = [];
    public $selectedElection = null;

    public function checkVoterId()
    {
        $this->validate(['voterId' => 'required|string']);

        $voters = Voter::where('voter_id', $this->voterId)->get();

        if ($voters->isEmpty()) {
            $this->addError('voterId', 'Invalid voter ID. Please check and try again.');
            return;
        }

        $this->voter = $voters->first();
        $electionIds = $voters->pluck('election_id')->unique();
        
        $this->elections = Election::whereIn('id', $electionIds)
            ->where(function($query) {
                $query->where('status', 'active')
                      ->orWhere('status', 'closed');
            })
            ->latest()
            ->get();

        if ($this->elections->isEmpty()) {
            $this->addError('voterId', 'No elections available for this voter ID.');
            return;
        }
    }

    public function vote()
    {
        if (!$this->selectedElection) {
            $this->addError('selectedElection', 'Please select an election.');
            return;
        }

        return redirect()->route('election.vote', $this->selectedElection)
            ->with('prefilledVoterId', $this->voterId);
    }

    public function reset()
    {
        $this->reset(['voterId', 'voter', 'elections', 'selectedElection']);
    }

    public function render()
    {
        return view('livewire.election.public-portal')->layout('layouts.welcome');
    }
}
