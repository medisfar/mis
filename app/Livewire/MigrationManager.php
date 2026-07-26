<?php

namespace App\Livewire;

use Livewire\Component;

class MigrationManager extends Component
{
    public $mig=[];
    public function render()
    {
        $this->mig=\DB::select('select * from migrations');
        return view('livewire.migration-manager',['mig'=>$this->mig]);;
    }
}
