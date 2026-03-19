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
        $positions = $this->election->positions()
            ->with(['candidates' => function($query) {
                $query->withCount('votes')->orderByDesc('votes_count');
            }])
            ->get();

        $unassignedCandidates = $this->election->candidates()
            ->whereNull('position_id')
            ->withCount('votes')
            ->orderByDesc('votes_count')
            ->get();

        $totalVotes = $this->election->votes()->count();

        return view('livewire.election.results', [
            'positions' => $positions,
            'unassignedCandidates' => $unassignedCandidates,
            'totalVotes' => $totalVotes,
            'totalVoters' => $this->election->voters()->count(),
            'voterTurnout' => $this->election->voters()->where('has_voted', true)->count(),
        ])->layout('layouts.welcome');
    }
}
