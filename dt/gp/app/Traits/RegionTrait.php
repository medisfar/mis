<?php
namespace App\Traits;
use Livewire\Component;
use \App\Models\Region;
Trait RegionTrait {
  protected $regions,$unregion;
  public  $sid,$state='home',$search;
  public $code,$nom_region;

public function resetRegion() {
	 $this->code  = '';
	 $this->nom_region  = '';
}

public function cancelRegion() {
	 $this->state       = 'home';
}

public function createRegion() {
	 $this->state       = 'create';
 	$this->sid = null;
	$this->unregion = new Region;
}

public function storeRegion() {
	$this->validate([
 	'code'    => 'required', 
 	'nom_region'    => 'required', 
	]);
	$unregion = new Region;
	$unregion->create([
 	'code'    => $this->code, 
 	'nom_region'    => $this->nom_region, 
	]);
	$this->resetRegion();
	 return redirect()->route('geolocalisation.regions');
}

public function showRegion($id) {
	 $this->state       = 'show';
 	$this->sid = $id;
	$this->unregion =  Region::find($id);
 	$this->code    = $this->unregion->code; 
 	$this->nom_region    = $this->unregion->nom_region; 
}

public function editRegion($id) {
	 $this->state       = 'edit';
 	$this->sid = $id;
	$this->unregion =  Region::find($id);
if($this->unregion != null) {
 	$this->code    = $this->unregion->code; 
 	$this->nom_region    = $this->unregion->nom_region; 
}}

public function updateRegion() {
	$this->validate([
 	'code'    => 'required', 
 	'nom_region'    => 'required', 
	]);
	if ($this->sid) {
   $unregion = Region::find($this->sid);
	$unregion->update([
 	'code'    => $this->code, 
 	'nom_region'    => $this->nom_region, 
	]);
	$this->resetRegion();
	 return redirect()->route('geolocalisation.regions');

}}

public function destroyRegion($id)
{
 if ($id) {
  	   $unregion = Region::find( $id);
   	 $unregion->delete();
	}


	 return redirect()->route('geolocalisation.regions');
}

}
