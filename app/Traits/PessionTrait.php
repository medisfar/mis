<?php
namespace App\Traits;
use Livewire\Component;
use \App\Models\Psession;
Trait PsessiomTrait {
  protected $psessions,$unPsessiom;
  public  $sid,$state='home',$search;
  public $nom,$projet_id,$actif;

public function resetPsessiom() {
	 $this->nom  = '';
	 $this->projet_id  = '';
	 $this->actif  = '';
}

public function cancelPsessiom() {
	 $this->state       = 'home';
}

public function createPsessiom() {
	 $this->state       = 'create';
 	$this->sid = null;
	$this->unPsessiom = new Psessiom;
}

public function storePsessiom() {
	$this->validate([
 	'nom'    => 'required', 
 	'projet_id'    => 'required', 
 	'actif'    => 'required', 
	]);
	$unPsessiom = new Psessiom;
	$unPsessiom->create([
 	'nom'    => $this->nom, 
 	'projet_id'    => $this->projet_id, 
 	'actif'    => $this->actif, 
	]);
	$this->resetPsessiom();
	 return redirect()->route('datacollect.psessions');
}

public function showPsessiom($id) {
	 $this->state       = 'show';
 	$this->sid = $id;
	$this->unPsessiom =  Psessiom::find($id);
 	$this->nom    = $this->unPsessiom->nom; 
 	$this->projet_id    = $this->unPsessiom->projet_id; 
 	$this->actif    = $this->unPsessiom->actif; 
}

public function editPsessiom($id) {
	 $this->state       = 'edit';
 	$this->sid = $id;
	$this->unPsessiom =  Psessiom::find($id);
if($this->unPsessiom != null) {
 	$this->nom    = $this->unPsessiom->nom; 
 	$this->projet_id    = $this->unPsessiom->projet_id; 
 	$this->actif    = $this->unPsessiom->actif; 
}}

public function updatePsessiom() {
	$this->validate([
 	'nom'    => 'required', 
 	'projet_id'    => 'required', 
 	'actif'    => 'required', 
	]);
	if ($this->sid) {
   $unPsessiom = Psession::find($this->sid);
	$unPsessiom->update([
 	'nom'    => $this->nom, 
 	'projet_id'    => $this->projet_id, 
 	'actif'    => $this->actif, 
	]);
	$this->resetPsessiom();
	 return redirect()->route('datacollect.psessions');

}}

public function destroyPsessiom($id)
{
 if ($id) {
  	   $unPsessiom = Psessiom::find( $id);
   	 $unPsessiom->delete();
	}


	 return redirect()->route('datacollect.psessions');
}

}
