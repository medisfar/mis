<?php
namespace App\Traits;
use Livewire\Component;
use \App\Models\Zone;
Trait ZoneTrait {
  protected $zones,$unzone;
  public  $sid,$state='home',$search;
  public $nom_zone,$localite_id;

public function resetZone() {
	 $this->nom_zone  = '';
	 $this->localite_id  = '';
	
}

public function cancelZone() {
	 $this->state       = 'home';
}

public function createZone() {
	 $this->state       = 'create';
 	$this->sid = null;
	$this->unzone = new Zone;
}

public function storeZone() {
	$this->validate([
 	'nom_zone'    => 'required', 
 	'localite_id'    => 'required', 
 
	]);
	$unzone = new Zone;
	$unzone->create([
 	'nom_zone'    => $this->nom_zone, 
 	'localite_id'    => $this->localite_id, 
 	
	]);
	$this->resetZone();
	$this->dispatch('hide-modal');
	 //return redirect()->route('geolocalisation.zones');
}

public function showZone($id) {
	 $this->state       = 'show';
 	$this->sid = $id;
	$this->unzone =  Zone::find($id);
 	$this->nom_zone    = $this->unzone->nom_zone; 
 	$this->localite_id    = $this->unzone->localite_id; 
 	
}

public function editZone($id) {
	 $this->state       = 'edit';
 	$this->sid = $id;
	$this->unzone =  Zone::find($id);
if($this->unzone != null) {
 	$this->nom_zone    = $this->unzone->nom_zone; 
 	$this->localite_id    = $this->unzone->localite_id; 
 	
}}

public function updateZone() {
	$this->validate([
 	'nom_zone'    => 'required', 
 	'localite_id'    => 'required', 
 
	]);
	if ($this->sid) {
   $unzone = Zone::find($this->sid);
	$unzone->update([
 	'nom_zone'    => $this->nom_zone, 
 	'localite_id'    => $this->localite_id, 
 	
	]);
	$this->resetZone();
	$this->dispatch('hide-modal');
	 //return redirect()->route('geolocalisation.zones');

}}

public function destroyZone($id)
{
 if ($id) {
  	   $unzone = Zone::find( $id);
   	 $unzone->delete();
	}


	 return redirect()->route('geolocalisation.zones');
}

}
