<?php
namespace App\Traits;
use Livewire\Component;
use \App\Models\Activite;
Trait ActiviteTrait {
  protected $activites,$unactivite;
  public  $sid,$state='home',$search;
  public $nom_activite,$composante_id,$sous_composante_id,$date_debut,$date_fin,$completed;

public function resetActivite() {
	 $this->nom_activite  = '';
	 $this->composante_id  = '';
	 $this->sous_composante_id  = '';
	 $this->date_debut  = '';
	 $this->date_fin  = '';
	 $this->completed  = '';
}

public function cancelActivite() {
	 $this->state       = 'home';
}

public function createActivite() {
	 $this->state       = 'create';
 	$this->sid = null;
	$this->unactivite = new Activite;
}

public function storeActivite() {
	$this->validate([
 	'nom_activite'    => 'required', 
 	'composante_id'    => 'required', 
 	'sous_composante_id'    => 'required', 
 	'date_debut'    => 'required', 
 	'date_fin'    => 'required', 
 	'completed'    => 'required', 
	]);
	$unactivite = new Activite;
	$unactivite->create([
 	'nom_activite'    => $this->nom_activite, 
 	'composante_id'    => $this->composante_id, 
 	'sous_composante_id'    => $this->sous_composante_id, 
 	'date_debut'    => $this->date_debut, 
 	'date_fin'    => $this->date_fin, 
 	'completed'    => $this->completed, 
	]);
	$this->resetActivite();
	 return redirect()->route('projet.activites');
}

public function showActivite($id) {
	 $this->state       = 'show';
 	$this->sid = $id;
	$this->unactivite =  Activite::find($id);
 	$this->nom_activite    = $this->unactivite->nom_activite; 
 	$this->composante_id    = $this->unactivite->composante_id; 
 	$this->sous_composante_id    = $this->unactivite->sous_composante_id; 
 	$this->date_debut    = $this->unactivite->date_debut; 
 	$this->date_fin    = $this->unactivite->date_fin; 
 	$this->completed    = $this->unactivite->completed; 
}

public function editActivite($id) {
	 $this->state       = 'edit';
 	$this->sid = $id;
	$this->unactivite =  Activite::find($id);
if($this->unactivite != null) {
 	$this->nom_activite    = $this->unactivite->nom_activite; 
 	$this->composante_id    = $this->unactivite->composante_id; 
 	$this->sous_composante_id    = $this->unactivite->sous_composante_id; 
 	$this->date_debut    = $this->unactivite->date_debut; 
 	$this->date_fin    = $this->unactivite->date_fin; 
 	$this->completed    = $this->unactivite->completed; 
}}

public function updateActivite() {
	$this->validate([
 	'nom_activite'    => 'required', 
 	'composante_id'    => 'required', 
 	'sous_composante_id'    => 'required', 
 	'date_debut'    => 'required', 
 	'date_fin'    => 'required', 
 	'completed'    => 'required', 
	]);
	if ($this->sid) {
   $unactivite = Activite::find($this->sid);
	$unactivite->update([
 	'nom_activite'    => $this->nom_activite, 
 	'composante_id'    => $this->composante_id, 
 	'sous_composante_id'    => $this->sous_composante_id, 
 	'date_debut'    => $this->date_debut, 
 	'date_fin'    => $this->date_fin, 
 	'completed'    => $this->completed, 
	]);
	$this->resetActivite();
	 return redirect()->route('projet.activites');

}}

public function destroyActivite($id)
{
 if ($id) {
  	   $unactivite = Activite::find( $id);
   	 $unactivite->delete();
	}


	 return redirect()->route('projet.activites');
}

}
