<?php

namespace App\Livewire;

use Livewire\Component;

class Dashboard extends Component
{
    protected $listeners = ['refreshDashboard' => '$refresh'];

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('livewire.dashboard', ['house' => auth()->user()->house]);
    }
}
