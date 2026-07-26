<?php

namespace App\Livewire;

use Livewire\Component;

class Lien extends Component
{
    public $lien;
    public function render()
    {
        $p=\App\Models\Lien::orderBy('created_at','desc')->paginate(10);
        return view('livewire.lien',['ls'=>$p]);
    }
    public function add(){
        \App\Models\Lien::create(['liendoc'=>$this->lien]);
    }
}
