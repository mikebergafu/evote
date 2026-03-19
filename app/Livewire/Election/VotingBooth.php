<?php

namespace App\Livewire\Election;

use App\Models\Election;
use App\Models\Voter;
use App\Models\Vote;
use App\Services\DeviceFingerprint;
use Livewire\Component;

class VotingBooth extends Component
{
    public Election $election;
    public $voterId = '';
    public $voter = null;
    public $currentStep = 0;
    public $positions = [];
    public $votes = [];
    public $selectedCandidateId = null;
    public $showConfirmation = false;

    public function mount(Election $election)
    {
        // Check if voting period is valid
        if (now()->isBefore($election->starts_at)) {
            abort(403, 'Voting has not started yet. Voting starts on ' . $election->starts_at->format('M d, Y H:i'));
        }
        
        if (now()->isAfter($election->ends_at)) {
            abort(403, 'Voting has ended. Voting ended on ' . $election->ends_at->format('M d, Y H:i'));
        }
        
        abort_unless($election->isActive(), 403, 'Election is not active.');
        $this->election = $election;
        $this->loadPositions();
        
        // Prefill voter ID if coming from public portal
        if (session()->has('prefilledVoterId')) {
            $this->voterId = session('prefilledVoterId');
            session()->forget('prefilledVoterId');
        }
    }

    public function loadPositions()
    {
        $this->positions = $this->election->candidates()
            ->select('position', 'position_name')
            ->groupBy('position', 'position_name')
            ->orderBy('position')
            ->get()
            ->toArray();
    }

    public function authenticate()
    {
        $this->validate(['voterId' => 'required|string']);

        $voter = Voter::where('election_id', $this->election->id)
            ->where('voter_id', $this->voterId)
            ->first();

        if (!$voter) {
            $this->addError('voterId', 'Invalid voter ID.');
            return;
        }

        if ($voter->has_voted) {
            $this->addError('voterId', 'You have already voted.');
            return;
        }

        $currentDevice = DeviceFingerprint::generate();

        // Check if this device has already voted in this election
        $deviceAlreadyVoted = Voter::where('election_id', $this->election->id)
            ->where('device_fingerprint', $currentDevice)
            ->where('has_voted', true)
            ->exists();

        if ($deviceAlreadyVoted) {
            $this->addError('voterId', 'This device has already been used to vote in this election.');
            return;
        }

        if (!$voter->device_registered) {
            $voter->update([
                'device_fingerprint' => $currentDevice,
                'device_registered' => true,
            ]);
            $this->voter = $voter;
        } else {
            if (!hash_equals($voter->device_fingerprint, $currentDevice)) {
                $this->addError('voterId', 'This voter is registered on a different device.');
                return;
            }
            $this->voter = $voter;
        }
    }

    public function selectCandidate($candidateId)
    {
        $this->selectedCandidateId = $candidateId;
        $this->showConfirmation = true;
    }

    public function confirmVote()
    {
        if (!$this->voter || !$this->selectedCandidateId) {
            return;
        }

        $currentPosition = $this->positions[$this->currentStep];
        $this->votes[$currentPosition['position']] = $this->selectedCandidateId;

        $this->selectedCandidateId = null;
        $this->showConfirmation = false;

        if ($this->currentStep < count($this->positions) - 1) {
            $this->currentStep++;
        } else {
            $this->submitAllVotes();
        }
    }

    public function submitAllVotes()
    {
        foreach ($this->votes as $position => $candidateId) {
            Vote::create([
                'election_id' => $this->election->id,
                'candidate_id' => $candidateId === 'no' ? null : $candidateId,
                'vote_hash' => hash('sha256', $this->voter->id . $position . time() . rand()),
            ]);
        }

        $this->voter->update([
            'has_voted' => true,
            'voted_at' => now(),
        ]);

        session()->flash('message', 'All votes cast successfully!');
        return redirect()->route('election.vote', $this->election);
    }

    public function previousStep()
    {
        if ($this->currentStep > 0) {
            $this->currentStep--;
            $this->showConfirmation = false;
            $this->selectedCandidateId = null;
        }
    }

    public function cancelVote()
    {
        $this->showConfirmation = false;
        $this->selectedCandidateId = null;
    }

    public function logout()
    {
        $this->reset(['voter', 'voterId', 'currentStep', 'votes', 'selectedCandidateId', 'showConfirmation']);
    }

    public function render()
    {
        $candidates = [];
        if ($this->voter && isset($this->positions[$this->currentStep])) {
            $currentPosition = $this->positions[$this->currentStep];
            $candidates = $this->election->candidates()
                ->where('position', $currentPosition['position'])
                ->get();
        }

        return view('livewire.election.voting-booth', [
            'candidates' => $candidates,
            'currentPosition' => $this->positions[$this->currentStep] ?? null,
            'totalSteps' => count($this->positions),
        ])->layout('layouts.welcome');
    }
}
