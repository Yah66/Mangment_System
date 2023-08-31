<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;

class Grade extends Component
{
    public function render()
    {
        // dd('asdasdasd');
        return view('livewire.dashboard.grade')->extends('empty');
    }
}
