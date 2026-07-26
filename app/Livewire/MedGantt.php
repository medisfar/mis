<?php

namespace App\Livewire;

use Livewire\Component;

class MedGantt extends Component
{
    public $dc,$an,$mois;

    public function mount($id)
    {
        $this->dc=\App\Models\Composante::find($id)->activites;
        $an=2024;
        $mois=1;
    }

    public function render()
    {
        return view('livewire.med-gantt');
    }
}
