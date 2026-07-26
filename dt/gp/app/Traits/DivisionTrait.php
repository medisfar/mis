<?php
namespace App\Traits;
use Livewire\Component;
use \App\Models\Division;
Trait DivisionTrait {
  protected $divisions,$undivision;
  public  $sid,$state='home',$search;
  public $division,$type;

public function resetDivision() {
	 $this->division  = '';
	 $this->type  = '';
}

public function cancelDivision() {
	 $this->state       = 'home';
}

public function createDivision() {
	 $this->state       = 'create';
 	$this->sid = null;
	$this->undivision = new Division;
}

public function storeDivision() {
	$this->validate([
 	'division'    => 'required', 
 	'type'    => 'required', 
	]);
	$undivision = new Division;
	$undivision->create([
 	'division'    => $this->division, 
 	'type'    => $this->type, 
	]);
	$this->resetDivision();
	 return redirect()->route('geolocalisation.divisions');
}

public function showDivision($id) {
	 $this->state       = 'show';
 	$this->sid = $id;
	$this->undivision =  Division::find($id);
 	$this->division    = $this->undivision->division; 
 	$this->type    = $this->undivision->type; 
}

public function editDivision($id) {
	 $this->state       = 'edit';
 	$this->sid = $id;
	$this->undivision =  Division::find($id);
if($this->undivision != null) {
 	$this->division    = $this->undivision->division; 
 	$this->type    = $this->undivision->type; 
}}

public function updateDivision() {
	$this->validate([
 	'division'    => 'required', 
 	'type'    => 'required', 
	]);
	if ($this->sid) {
   $undivision = Division::find($this->sid);
	$undivision->update([
 	'division'    => $this->division, 
 	'type'    => $this->type, 
	]);
	$this->resetDivision();
	 return redirect()->route('geolocalisation.divisions');

}}

public function destroyDivision($id)
{
 if ($id) {
  	   $undivision = Division::find( $id);
   	 $undivision->delete();
	}


	 return redirect()->route('geolocalisation.divisions');
}

}
