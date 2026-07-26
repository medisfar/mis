<?php
namespace App\Traits;
use Livewire\Component;
use \App\Models\Mission;
Trait MissionTrait {
  protected $missions,$unmission;
  public  $sid,$state='home',$search;
  public $libelle,$description;

public function resetMission() {
	 $this->libelle  = '';
	 $this->description  = '';
}

public function cancelMission() {
	 $this->state       = 'home';
}

public function createMission() {
	 $this->state       = 'create';
 	$this->sid = null;
	$this->unmission = new Mission;
}

public function storeMission() {
	$this->validate([
 	'libelle'    => 'required', 
 	'description'    => 'required', 
	]);
	$unmission = new Mission;
	$unmission->create([
 	'libelle'    => $this->libelle, 
 	'description'    => $this->description, 
	]);
	$this->resetMission();
	 return redirect()->route('projet.missions');
}

public function showMission($id) {
	 $this->state       = 'show';
 	$this->sid = $id;
	$this->unmission =  Mission::find($id);
 	$this->libelle    = $this->unmission->libelle; 
 	$this->description    = $this->unmission->description; 
}

public function editMission($id) {
	 $this->state       = 'edit';
 	$this->sid = $id;
	$this->unmission =  Mission::find($id);
if($this->unmission != null) {
 	$this->libelle    = $this->unmission->libelle; 
 	$this->description    = $this->unmission->description; 
}}

public function updateMission() {
	$this->validate([
 	'libelle'    => 'required', 
 	'description'    => 'required', 
	]);
	if ($this->sid) {
   $unmission = Mission::find($this->sid);
	$unmission->update([
 	'libelle'    => $this->libelle, 
 	'description'    => $this->description, 
	]);
	$this->resetMission();
	 return redirect()->route('projet.missions');

}}

public function destroyMission($id)
{
 if ($id) {
  	   $unmission = Mission::find( $id);
   	 $unmission->delete();
	}


	 return redirect()->route('projet.missions');
}

}
