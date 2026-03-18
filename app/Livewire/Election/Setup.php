<?php

namespace App\Livewire\Election;

use App\Models\Election;
use Livewire\Component;

class Setup extends Component
{
    public $name = '';
    public $description = '';
    public $starts_at = '';
    public $ends_at = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'starts_at' => 'required|date|after:now',
        'ends_at' => 'required|date|after:starts_at',
    ];

    public function createElection()
    {
        $this->validate();

        $election = Election::create([
            'name' => $this->name,
            'description' => $this->description,
            'starts_at' => $this->starts_at,
            'ends_at' => $this->ends_at,
            'status' => 'setup',
        ]);

        session()->flash('message', 'Election created successfully! Now add candidates.');
        return redirect()->route('election.manage', $election);
    }

    public function render()
    {
        return view('livewire.election.setup');
    }
}
