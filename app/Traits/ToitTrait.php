<?php
namespace App\Traits;
use Livewire\Component;
use \App\Models\Toit;
Trait ToitTrait {
  protected $toits,$untoit;
  public  $sid,$state='home',$search;
  public $zone_id,$adresse;

public function resetToit() {
	 $this->zone_id  = '';
	 $this->adresse  = '';
}

public function cancelToit() {
	 $this->state       = 'home';
}

public function createToit() {
	 $this->state       = 'create';
 	$this->sid = null;
	$this->untoit = new Toit;
}

public function storeToit() {
	$this->validate([
 	'zone_id'    => 'required', 
 	'adresse'    => 'required', 
	]);
	$untoit = new Toit;
	$untoit->create([
 	'zone_id'    => $this->zone_id, 
 	'adresse'    => $this->adresse, 
	]);
	$this->resetToit();
	 return redirect()->route('datacollect.toits');
}

public function showToit($id) {
	 $this->state       = 'show';
 	$this->sid = $id;
	$this->untoit =  Toit::find($id);
 	$this->zone_id    = $this->untoit->zone_id; 
 	$this->adresse    = $this->untoit->adresse; 
}

public function editToit($id) {
	 $this->state       = 'edit';
 	$this->sid = $id;
	$this->untoit =  Toit::find($id);
if($this->untoit != null) {
 	$this->zone_id    = $this->untoit->zone_id; 
 	$this->adresse    = $this->untoit->adresse; 
}}

public function updateToit() {
	$this->validate([
 	'zone_id'    => 'required', 
 	'adresse'    => 'required', 
	]);
	if ($this->sid) {
   $untoit = Toit::find($this->sid);
	$untoit->update([
 	'zone_id'    => $this->zone_id, 
 	'adresse'    => $this->adresse, 
	]);
	$this->resetToit();
	 return redirect()->route('datacollect.toits');

}}

public function destroyToit($id)
{
 if ($id) {
  	   $untoit = Toit::find( $id);
   	 $untoit->delete();
	}


	 return redirect()->route('datacollect.toits');
}

}
