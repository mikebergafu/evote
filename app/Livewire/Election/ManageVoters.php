<?php

namespace App\Livewire\Election;

use App\Models\Election;
use App\Models\Voter;
use Livewire\Component;
use Livewire\WithPagination;

class ManageVoters extends Component
{
    use WithPagination;

    public Election $election;
    public $search = '';

    public function mount(Election $election)
    {
        $this->election = $election;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function removeDeviceRegistration($voterId)
    {
        $voter = Voter::findOrFail($voterId);
        $voter->update([
            'device_fingerprint' => null,
            'device_registered' => false,
        ]);
        
        session()->flash('message', 'Device registration removed for ' . $voter->name);
    }

    public function render()
    {
        $voters = $this->election->voters()
            ->when($this->search, function($query) {
                $query->where(function($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('voter_id', 'like', '%' . $this->search . '%')
                      ->orWhere('phone', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('livewire.election.manage-voters', compact('voters'));
    }
}
