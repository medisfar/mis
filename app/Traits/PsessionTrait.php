<?php
namespace App\Traits;
use Livewire\Component;
use \App\Models\Psession;
Trait PsessionTrait {
  protected $psessions,$unpsession;
  public  $sid,$state='home',$search;
  public $nom,$projet_id,$actif;


public function resetPsession() {
	 $this->nom  = '';
	 $this->projet_id  = '';
	 $this->actif  = '';
}

public function cancelPsession() {
	 $this->state       = 'home';
}

public function createPsession() {
	 $this->state       = 'create';
 	$this->sid = null;
	$this->unpsession = new Psession;
}

public function storePsession() {
	$this->validate([
 	'nom'    => 'required', 
 	'projet_id'    => 'required', 
 	'actif'    => 'required', 
	]);
	$unpsession = new Psession;
	$unpsession->create([
 	'nom'    => $this->nom, 
 	'projet_id'    => $this->projet_id,
 	'fields'=>'[]', 
 	'actif'    => $this->actif, 
	]);
	$this->resetPsession();
	 return redirect()->route('datacollect.psessions');
}

public function showPsession($id) {
	 $this->state       = 'show';
 	$this->sid = $id;
	$this->unpsession =  Psession::find($id);
 	$this->nom    = $this->unpsession->nom; 
 	$this->projet_id    = $this->unpsession->projet_id; 
 	$this->actif    = $this->unpsession->actif; 
}

public function editPsession($id) {
	 $this->state       = 'edit';
 	$this->sid = $id;
	$this->unpsession =  Psession::find($id);
if($this->unpsession != null) {
 	$this->nom    = $this->unpsession->nom; 
 	$this->projet_id    = $this->unpsession->projet_id; 
 	$this->actif    = $this->unpsession->actif; 
}}

public function updatePsession() {
	$this->validate([
 	'nom'    => 'required', 
 	'projet_id'    => 'required', 
 	'actif'    => 'required', 
	]);
	if ($this->sid) {
   $unpsession = Psession::find($this->sid);
	$unpsession->update([
 	'nom'    => $this->nom, 
 	'projet_id'    => $this->projet_id, 
 	'actif'    => $this->actif, 
	]);
	$this->resetPsession();
	 return redirect()->route('datacollect.psessions');

}}

public function destroyPsession($id)
{
 if ($id) {
  	   $unpsession = Psession::find( $id);
   	 $unpsession->delete();
	}


	 return redirect()->route('datacollect.psessions');
}

}
