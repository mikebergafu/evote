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
        // Get positions with their candidates
        $positions = $this->election->positions()->orderBy('order')->get();
        
        $positionResults = [];
        foreach ($positions as $position) {
            $candidates = $this->election->candidates()
                ->where('position_id', $position->id)
                ->withCount('votes')
                ->get();
            
            $noVotes = $this->election->votes()
                ->where('position', $position->id)
                ->whereNull('candidate_id')
                ->count();
            
            $positionResults[] = [
                'position' => $position,
                'candidates' => $candidates,
                'noVotes' => $noVotes,
            ];
        }

        $totalVotes = $this->election->votes()->count();

        return view('livewire.election.results', [
            'positionResults' => $positionResults,
            'totalVotes' => $totalVotes,
            'totalVoters' => $this->election->voters()->count(),
            'voterTurnout' => $this->election->voters()->where('has_voted', true)->count(),
        ])->layout('layouts.welcome');
    }
}
