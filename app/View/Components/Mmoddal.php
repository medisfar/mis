<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Mmodal extends Component
{
     public $modalWidth = 'modal-lg';
    public function mount ($label,$cmp,$params){
        $this->cmp=$cmp;
        $this->label=$label;
        $this->params=$params;
         $this->mid='m'.rand(1,1000);
    }
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.mmodal');
    }
    public funtion closeIt($idm){
        $this->dispatch('close-modal',$idm);
    }

    public funtion closeIt($idm){
        $this->dispatch('hide-modal',$idm);
    }
}
