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
    public $selectedCandidateId = null;
    public $showConfirmation = false;

    public function mount(Election $election)
    {
        abort_unless($election->isActive(), 403, 'Election is not active.');
        $this->election = $election;
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

        if ($this->selectedCandidateId === 'no') {
            // Record a "no" vote - we'll store it with candidate_id as null or create a special handling
            Vote::create([
                'election_id' => $this->election->id,
                'candidate_id' => null,
                'vote_hash' => hash('sha256', $this->voter->id . time() . rand()),
            ]);
        } else {
            Vote::create([
                'election_id' => $this->election->id,
                'candidate_id' => $this->selectedCandidateId,
                'vote_hash' => hash('sha256', $this->voter->id . time() . rand()),
            ]);
        }

        $this->voter->update([
            'has_voted' => true,
            'voted_at' => now(),
        ]);

        session()->flash('message', 'Vote cast successfully!');
        return redirect()->route('election.vote', $this->election);
    }

    public function cancelVote()
    {
        $this->showConfirmation = false;
        $this->selectedCandidateId = null;
    }

    public function logout()
    {
        $this->reset(['voter', 'voterId', 'selectedCandidateId', 'showConfirmation']);
    }

    public function render()
    {
        return view('livewire.election.voting-booth', [
            'candidates' => $this->election->candidates()->with('electionPosition')->get(),
        ]);
    }
}
