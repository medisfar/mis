<?php

namespace App\Livewire;

use Livewire\Component;
use \App\Models\Projet;
class MonitoringIndex extends Component
{
   public $cid;
    public function render()
    { 
        return view('livewire.monitoring.index');
    }
    
}
