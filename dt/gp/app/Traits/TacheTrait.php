<?php
namespace App\Traits;
use Livewire\Component;
use \App\Models\Tache;
Trait TacheTrait {
  protected $taches,$untache;
  public  $sid,$state='home',$search;
  public $tache,$activite_id,$date_debut,$date_fin,$completed;

public function resetTache() {
	 $this->tache  = '';
	 $this->activite_id  = '';
	 $this->date_debut  = '';
	 $this->date_fin  = '';
	 $this->completed  = '';
}

public function cancelTache() {
	 $this->state       = 'home';
}

public function createTache() {
	 $this->state       = 'create';
 	$this->sid = null;
	$this->untache = new Tache;
}

public function storeTache() {
	$this->validate([
 	'tache'    => 'required', 
 	'activite_id'    => 'required', 
 	'date_debut'    => 'required', 
 	'date_fin'    => 'required', 
 	'completed'    => 'required', 
	]);
	$untache = new Tache;
	$untache->create([
 	'tache'    => $this->tache, 
 	'activite_id'    => $this->activite_id, 
 	'date_debut'    => $this->date_debut, 
 	'date_fin'    => $this->date_fin, 
 	'completed'    => $this->completed, 
	]);
	$this->resetTache();
	 return redirect()->route('projet.taches');
}

public function showTache($id) {
	 $this->state       = 'show';
 	$this->sid = $id;
	$this->untache =  Tache::find($id);
 	$this->tache    = $this->untache->tache; 
 	$this->activite_id    = $this->untache->activite_id; 
 	$this->date_debut    = $this->untache->date_debut; 
 	$this->date_fin    = $this->untache->date_fin; 
 	$this->completed    = $this->untache->completed; 
}

public function editTache($id) {
	 $this->state       = 'edit';
 	$this->sid = $id;
	$this->untache =  Tache::find($id);
if($this->untache != null) {
 	$this->tache    = $this->untache->tache; 
 	$this->activite_id    = $this->untache->activite_id; 
 	$this->date_debut    = $this->untache->date_debut; 
 	$this->date_fin    = $this->untache->date_fin; 
 	$this->completed    = $this->untache->completed; 
}}

public function updateTache() {
	$this->validate([
 	'tache'    => 'required', 
 	'activite_id'    => 'required', 
 	'date_debut'    => 'required', 
 	'date_fin'    => 'required', 
 	'completed'    => 'required', 
	]);
	if ($this->sid) {
   $untache = Tache::find($this->sid);
	$untache->update([
 	'tache'    => $this->tache, 
 	'activite_id'    => $this->activite_id, 
 	'date_debut'    => $this->date_debut, 
 	'date_fin'    => $this->date_fin, 
 	'completed'    => $this->completed, 
	]);
	$this->resetTache();
	 return redirect()->route('projet.taches');

}}

public function destroyTache($id)
{
 if ($id) {
  	   $untache = Tache::find( $id);
   	 $untache->delete();
	}


	 return redirect()->route('projet.taches');
}

}
