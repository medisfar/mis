<?php
// app/Livewire/Components/MapModal.php

namespace App\Livewire;

use Livewire\Component;

class MapManyModal extends Component
{
    public $title = 'Location';
    public $idl;
    public $mapUrl;
    
    public function mount($lat = null, $lng = null, $title = null)
    {  //dd([$lat,$lng]);
        
        $this->title = $title ?? 'Selected Location';
        
        // Build the simple map URL
        $this->mapUrl = url("/map/{$this->idl}");
    }
    
    public function render()
    {
        return view('livewire.map-modal');
    }
}