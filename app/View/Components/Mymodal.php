<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Mymodal extends Component
{
     public $modalWidth = 'modal-lg';
     public $isOpen = false,$label,$cmp,$params,$mid;
      public function __construct($label,$cmp,$params,$mid){
        
        $this->cmp=$cmp;
        $this->label=$label;
        $this->params=$params;
         $this->mid=$mid;
         
    }
    
    
    public function render(): View|Closure|string
    {
        
        return view('components.mymodal');
    }
}
