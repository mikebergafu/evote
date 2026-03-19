<?php

namespace App\Livewire\Election;

use App\Models\Election;
use Livewire\Component;

class Results extends Component
{
    public Election $election;

    public function mount(Election $election)
    {
        $this->election = $election;
    }

    public function render()
    {
        // Group candidates by position
        $candidatesByPosition = $this->election->candidates()
            ->withCount('votes')
            ->orderBy('position')
            ->get()
            ->groupBy('position_name');

        $totalVotes = $this->election->votes()->count();

        return view('livewire.election.results', [
            'candidatesByPosition' => $candidatesByPosition,
            'totalVotes' => $totalVotes,
            'totalVoters' => $this->election->voters()->count(),
            'voterTurnout' => $this->election->voters()->where('has_voted', true)->count(),
        ])->layout('layouts.welcome');
    }
}
