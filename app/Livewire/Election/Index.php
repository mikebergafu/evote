<?php

namespace App\Livewire\Election;

use App\Models\Election;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.election.index', [
            'elections' => Election::latest()->get()
        ]);
    }
}
