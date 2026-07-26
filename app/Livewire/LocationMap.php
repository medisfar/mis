<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Site;

class LocationMap extends Component
{
    public $locations = [];
    public $newLocationName = '';
    
    public function mount($idl)
    {
        $this->loadLocations($idl);
      //.dd($this->locations);
    }
    
public function updateLocation($id,$newLat, $newLng){
$s=\App\Models\Site::find($id);
$s->lattitude=$newLat;
$s->longitude= $newLng;
$s->save();
}

    public function loadLocations($idl)
    {
        $this->locations = [];
        $ss = \App\Models\Activite::find($idl)->sites;
       // dd($ss);
        foreach($ss as $s) {
            if( $s->lattitude !=null && $s->longitude )
            $this->locations[] = [
                'name' => $s->nom, 
                'lat' => $s->lattitude, 
                'lng' => $s->longitude,
                'id' => $s->id
            ];
        } // $this->locations = [[11.50,43.12]];
    }

    public function addLocation($lat, $lng, $name)
    {
        // Save to database
        $site = Site::create([
            'nom' => $name,
            'lattitude' => $lat,
            'longitude' => $lng,
        ]);
        
        // Reload locations
        $this->loadLocations();
        
        // Dispatch event to refresh map
        $this->dispatch('locationAdded', [
            'id' => $site->id,
            'budget'=>$site->budget??0,
            'name' => $name,
            'lat' => $lat,
            'lng' => $lng
        ]);
        
        $this->newLocationName = '';
    }

    public function render()
    { //dd($this->locations);
        return view('livewire.location-map', [
            'locations' => $this->locations
        ])->layout('components.layouts.blank');
    }
}