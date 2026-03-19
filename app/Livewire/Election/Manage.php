<?php

namespace App\Livewire\Election;

use App\Models\Election;
use App\Models\Voter;
use App\Models\Candidate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Manage extends Component
{
    use WithFileUploads;

    public Election $election;
    public $showRegistrationLink = false;
    public $voterName = '';
    public $voterId = '';
    public $voterPhone = '';
    public $candidateName = '';
    public $candidateBio = '';
    public $candidatePhoto = null;
    public $candidatePositionId = null;
    public $candidateUserId = null;
    public $positionTitle = '';
    public $positionDescription = '';

    protected $rules = [
        'voterName' => 'required|string|max:255',
        'voterId' => 'required|string|max:255',
        'candidateName' => 'required|string|max:255',
        'candidateBio' => 'nullable|string',
        'candidatePhoto' => 'nullable|image|max:2048',
    ];

    public function mount(Election $election)
    {
        $this->election = $election;
    }

    public function addVoter()
    {
        $this->validate([
            'voterName' => 'required|string|max:255',
            'voterId' => 'required|string|max:255',
            'voterPhone' => 'nullable|string|max:20',
        ]);

        Voter::create([
            'election_id' => $this->election->id,
            'voter_id' => $this->voterId,
            'name' => $this->voterName,
            'phone' => $this->voterPhone,
        ]);

        $this->reset(['voterName', 'voterId', 'voterPhone']);
        $this->election->refresh();
        session()->flash('message', 'Voter added successfully!');
    }

    public function removeVoter($voterId)
    {
        Voter::where('election_id', $this->election->id)
            ->where('id', $voterId)
            ->delete();
        
        $this->election->refresh();
    }

    public function addCandidate()
    {
        $this->validate([
            'candidateName' => 'required|string|max:255',
            'candidateBio' => 'nullable|string',
            'candidatePhoto' => 'nullable|image|max:2048',
            'candidatePositionId' => 'nullable|exists:positions,id',
            'candidateUserId' => 'nullable|exists:users,id',
        ]);

        $photoPath = null;
        if ($this->candidatePhoto) {
            $photoPath = $this->candidatePhoto->store('candidates', 'public');
        }

        $position = $this->election->candidates()->max('position') + 1;

        Candidate::create([
            'election_id' => $this->election->id,
            'user_id' => $this->candidateUserId,
            'position_id' => $this->candidatePositionId,
            'name' => $this->candidateName,
            'bio' => $this->candidateBio,
            'photo' => $photoPath,
            'position' => $position,
        ]);

        $this->reset(['candidateName', 'candidateBio', 'candidatePhoto', 'candidatePositionId', 'candidateUserId']);
        $this->election->refresh();
        session()->flash('message', 'Candidate added successfully!');
    }

    public function addPosition()
    {
        $this->validate([
            'positionTitle' => 'required|string|max:255',
            'positionDescription' => 'nullable|string',
        ]);

        $order = $this->election->positions()->max('order') + 1;

        \App\Models\Position::create([
            'election_id' => $this->election->id,
            'title' => $this->positionTitle,
            'description' => $this->positionDescription,
            'order' => $order,
        ]);

        $this->reset(['positionTitle', 'positionDescription']);
        $this->election->refresh();
        session()->flash('message', 'Position added successfully!');
    }

    public function removePosition($positionId)
    {
        \App\Models\Position::where('election_id', $this->election->id)
            ->where('id', $positionId)
            ->delete();
        
        $this->election->refresh();
    }

    public function removeCandidate($candidateId)
    {
        Candidate::where('election_id', $this->election->id)
            ->where('id', $candidateId)
            ->delete();
        
        $this->election->refresh();
    }

    public function activateElection()
    {
        if ($this->election->candidates()->count() < 1) {
            session()->flash('error', 'Add at least 1 candidate before activating.');
            return;
        }

        if ($this->election->voters()->count() < 1) {
            session()->flash('error', 'Add at least one voter before activating.');
            return;
        }

        $this->election->update(['status' => 'active']);
        session()->flash('message', 'Election activated!');
    }

    public function closeElection()
    {
        $this->election->update(['status' => 'closed']);
        session()->flash('message', 'Election closed!');
    }

    public function deleteElection()
    {
        $this->election->delete();
        return redirect()->route('dashboard')->with('message', 'Election deleted successfully!');
    }

    public function copyRegistrationLink()
    {
        $this->showRegistrationLink = true;
        $this->dispatch('link-copied');
    }

    public function approvePotentialVoter($potentialVoterId)
    {
        $potentialVoter = \App\Models\PotentialVoter::findOrFail($potentialVoterId);
        
        $voterId = 'V' . str_pad($this->election->voters()->count() + 1, 6, '0', STR_PAD_LEFT);
        
        Voter::create([
            'election_id' => $this->election->id,
            'voter_id' => $voterId,
            'name' => $potentialVoter->full_name,
            'phone' => $potentialVoter->mobile,
        ]);
        
        $potentialVoter->delete();
        
        session()->flash('message', 'Voter approved successfully! Voter ID: ' . $voterId);
    }

    public function rejectPotentialVoter($potentialVoterId)
    {
        \App\Models\PotentialVoter::findOrFail($potentialVoterId)->delete();
        session()->flash('message', 'Voter registration rejected.');
    }

    public function render()
    {
        return view('livewire.election.manage', [
            'voters' => $this->election->voters()->get(),
            'candidates' => $this->election->candidates()->with('electionPosition')->get(),
            'positions' => $this->election->positions,
            'users' => \App\Models\User::orderBy('name')->get(),
            'potentialVoters' => \App\Models\PotentialVoter::where('election_id', $this->election->id)->latest()->get(),
        ]);
    }
}
