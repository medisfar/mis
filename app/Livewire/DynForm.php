<?php

namespace App\Livewire;

use Livewire\Component;

class DynForm extends Component
{
     public $sesid,$memid;
    public function mount($sesid,$memid){
        $this->sesid=$sesid;
        $this->memid=$memid;
    } 
    public function render()
    {
        return view('livewire.dyn-form');
    }
}
