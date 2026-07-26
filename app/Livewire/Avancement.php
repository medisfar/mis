<?php

namespace App\Livewire;

use Livewire\Component;
use \App\Models\Projet;
class Avancement extends Component
{
    public $pid,$sid;

    public function mount($id){
        $this->sid=$id;
    }
    public function render()
    { $p=Projet::find($this->sid);
    //dd($p);
        return view('livewire.avancement',['projet'=>$p]);
    }
}
