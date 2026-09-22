<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Menage;

class Outils extends Component
{
    public function render()
    {
        return view('livewire.outils', ['menagesCount' => Menage::count()]);
    }
}
