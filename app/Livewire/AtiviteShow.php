<?php

namespace App\Livewire;

use Livewire\Component;

class AtiviteShow extends Component {
    public $aid;
    public fuction mount($aid){
        $this->aid=$aid;
    }
    public function render()
    {
        return view('livewire.ativite-show');
    }
}
