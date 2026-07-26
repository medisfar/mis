<?php
// app/Livewire/Components/MapModal.php

namespace App\Livewire;

use Livewire\Component;

class MapModal extends Component
{
    public $title = 'Location';
    public $lat;
    public $lng;
    public $mapUrl;
    
    public function mount($lat = null, $lng = null, $title = null)
    {  //dd([$lat,$lng]);
        $this->lat = $lat ?? 11.5;
        $this->lng = $lng ?? 43.15;
        $this->title = $title ?? 'Selected Location';
        
        // Build the simple map URL
        $this->mapUrl = url("/simple-map/{$this->lat}/{$this->lng}");
    }
    
    public function render()
    {
        return view('livewire.map-modal');
    }
}