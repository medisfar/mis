<?php

namespace App\Livewire;

use Livewire\Component;

class Analytic extends Component
{
    public $selectedUrl;

    public function mount()
    {
        $this->selectedUrl = url('/analytics/projects');
    }

    public function render()
    {
        return view('livewire.analytic');
    }
}