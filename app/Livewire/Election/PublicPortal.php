<?php

namespace App\Livewire\Election;

use App\Models\Election;
use Livewire\Component;

class PublicPortal extends Component
{
    public $voterId = '';
    public $selectedElection = null;

    public function vote()
    {
        $this->validate(['voterId' => 'required|string']);

        if (!$this->selectedElection) {
            $this->addError('voterId', 'Please select an election first.');
            return;
        }

        return redirect()->route('election.vote', $this->selectedElection)
            ->with('prefilledVoterId', $this->voterId);
    }

    public function render()
    {
        $activeElections = Election::where('status', 'active')
            ->orWhere('status', 'closed')
            ->latest()
            ->get();

        return view('livewire.election.public-portal', [
            'elections' => $activeElections,
        ])->layout('layouts.guest');
    }
}
