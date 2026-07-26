<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Selectd extends Component
{
    public $fd;
    public $options;
    public $dependsOn;
    public $emitEvent;
    
    public function __construct($fd, $options = [], $dependsOn = null, $emitEvent=null)
    {
        $this->fd = $fd;
        $this->options = $options;
        $this->dependsOn = $dependsOn;
        $this->emitEvent= $emitEvent;
    }

    public function render()
    {
        return view('components.selectd');
    }
}