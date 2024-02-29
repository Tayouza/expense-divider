<?php

namespace App\Livewire;

use Livewire\Component;

class Dashboard extends Component
{
    protected $listeners = ['refreshDashboard' => '$refresh'];

    public function render()
    {
        return view('livewire.dashboard', ['house' => auth()->user()->house]);
    }
}
