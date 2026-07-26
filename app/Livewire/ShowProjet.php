<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class ShowProjet extends Component
{
    public $vue = null;
    public $idm = null;
    public $idp = null;
 public $t=[];
    
     public function mount($vue, $idm, $idp)
    {
        $this->vue = $vue;
        $this->idm = $idm;
        $this->idp = $idp;
    }

    public function handleViewUpdate($vue, $idm, $idp)
    {
        $this->vue = $vue;
        $this->idm = $idm;
        $this->idp = $idp;
        $this->render();
        //dd([$this->vue,$this->idm,$this->idp]);
    }

    public function render()
    {
        return view('livewire.show-projet');
    }
}