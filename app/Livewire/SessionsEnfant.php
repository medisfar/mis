<?php

namespace App\Livewire;

use Livewire\Component;

class SessionsEnfant extends Component
{
  public $mid;
  public function mount($mid){
      $this->mid=$mid;
  }
  public function render()
    {
        $donnes=\App\Models\MetaDonnee::where('membre_id',$this->mid)->get();
        return view('livewire.sessions-enfant',['donnees'=>$donnes]);
    }
}
