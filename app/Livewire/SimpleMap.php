<?php
// app/Livewire/SimpleMap.php

namespace App\Livewire;

use Livewire\Component;

class SimpleMap extends Component
{
    public $lat;
    public $lng;
    public $zoom = 15;
    public $title = 'Location';
    
    public function mount($lat, $lng, $title = null)
    {
        $this->lat = $lat;
        $this->lng = $lng;
        $this->title = $title ?? 'Selected Location';
    }
    
    public function render()
    {
        return view('livewire.simplemap')->layout('components.layouts.blank');
    }
}