<?php
namespace App\Traits;
use Livewire\Component;
use \App\Models\Subdivision;
Trait SubdivisionTrait {
  protected $subdivisions,$unsubdivision;
  public  $sid,$state='home',$search;
  public $division_id,$subdivision,$type;

public function resetSubdivision() {
	 $this->subdivision  = '';
	 $this->type  = '';
}

public function cancelSubdivision() {
	 $this->state       = 'home';
}

public function createSubdivision() {
	 $this->state       = 'create';
 	$this->sid = null;
	$this->unsubdivision = new Subdivision;
}

public function storeSubdivision() {
	$this->validate([
 	'subdivision'    => 'required', 
 	'division_id'    => 'required', 
 	'type'    => 'required', 
	]);
	$unsubdivision = new Subdivision;
	$unsubdivision->create([
 	'subdivision'    => $this->subdivision, 
 	'division_id'    => $this->division_id, 
 	'type'    => $this->type, 
	]);
	$this->resetSubdivision();
	 return redirect()->route('geolocalisation.subdivisions');
}

public function showSubdivision($id) {
	 $this->state       = 'show';
 	$this->sid = $id;
	$this->unsubdivision =  Subdivision::find($id);
 	$this->subdivision    = $this->unsubdivision->subdivision; 
 	$this->division_id   = $this->unsubdivision->division_id;
 	$this->type    = $this->unsubdivision->type; 
}

public function editSubdivision($id) {
	 $this->state       = 'edit';
 	$this->sid = $id;
	$this->unsubdivision =  Subdivision::find($id);
if($this->unsubdivision != null) {
 	$this->subdivision    = $this->unsubdivision->subdivision; 
 	$this->division_id   = $this->unsubdivision->division_id;
 	$this->type    = $this->unsubdivision->type; 
}}

public function updateSubdivision() {
	$this->validate([
 	'subdivision'    => 'required', 
 	'type'    => 'required', 
	]);
	if ($this->sid) {
   $unsubdivision = Subdivision::find($this->sid);
	$unsubdivision->update([
 	'subdivision'    => $this->subdivision, 
 	'division_id'    => $this->division_id,
 	'type'    => $this->type, 
	]);
	$this->resetSubdivision();
	 return redirect()->route('geolocalisation.subdivisions');

}}

public function destroySubdivision($id)
{
 if ($id) {
  	   $unsubdivision = Subdivision::find( $id);
   	 $unsubdivision->delete();
	}


	 return redirect()->route('geolocalisation.subdivisions');
}

}
