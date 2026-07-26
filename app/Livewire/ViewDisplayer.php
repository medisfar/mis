<?php

namespace App\Livewire;

use Livewire\Component;

class ViewDisplayer extends Component
{
    public $vue,$idm,$pid;

    protected $listeners = ['view-update' => 'handleViewUpdate'];


    public function render()
    {
        return view('livewire.view-displayer',
            ['vue'=>$this->vue,
            'idm'=>$this->idm,
            'idp'=>$this->idm,
    ]);
    }

    public function handleViewUpdate($vue,$idm,$idp)
{
    //dd($data);
    $this->vue=$vue;
    $this->idm = $idm;
    $this->idp = $idp;
    }
}
