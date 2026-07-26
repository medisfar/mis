<?php
namespace App\Traits;
use Livewire\Component;
use \App\Models\Projet;
Trait ProjetTrait {
  protected $projets,$unprojet;
  public  $sid,$state='home',$search;
  public $code,$nom_projet,$budget,$date_debut,$date_fin,$statut;

public function resetProjet() {
	 $this->code  = '';
	 $this->nom_projet  = '';
	 $this->budget  = '';
	 $this->date_debut  = '';
	 $this->date_fin  = '';
	 $this->statut  = '';
}

public function cancelProjet() {
	 $this->state       = 'home';
}

public function createProjet() {
	 $this->state       = 'create';
 	$this->sid = null;
	$this->unprojet = new Projet;
}

public function storeProjet() {
	$this->validate([
 	'code'    => 'required', 
 	'nom_projet'    => 'required', 
 	'budget'    => 'required', 
 	'date_debut'    => 'required', 
 	'date_fin'    => 'required', 
 	'statut'    => 'required', 
	]);
	$unprojet = new Projet;
	$unprojet->create([
 	'code'    => $this->code, 
 	'nom_projet'    => $this->nom_projet, 
 	'budget'    => $this->budget, 
 	'date_debut'    => $this->date_debut, 
 	'date_fin'    => $this->date_fin, 
 	'statut'    => $this->statut, 
	]);
	$this->resetProjet();
	 return redirect()->route('projet.projets');
}

public function showProjet($id) {
	 $this->state       = 'show';
 	$this->sid = $id;
	$this->unprojet =  Projet::find($id);
 	$this->code    = $this->unprojet->code; 
 	$this->nom_projet    = $this->unprojet->nom_projet; 
 	$this->budget    = $this->unprojet->budget; 
 	$this->date_debut    = $this->unprojet->date_debut; 
 	$this->date_fin    = $this->unprojet->date_fin; 
 	$this->statut    = $this->unprojet->statut; 
}

public function editProjet($id) {
	 $this->state       = 'edit';
 	$this->sid = $id;
	$this->unprojet =  Projet::find($id);
if($this->unprojet != null) {
 	$this->code    = $this->unprojet->code; 
 	$this->nom_projet    = $this->unprojet->nom_projet; 
 	$this->budget    = $this->unprojet->budget; 
 	$this->date_debut    = $this->unprojet->date_debut; 
 	$this->date_fin    = $this->unprojet->date_fin; 
 	$this->statut    = $this->unprojet->statut; 
}}

public function updateProjet() {
	$this->validate([
 	'code'    => 'required', 
 	'nom_projet'    => 'required', 
 	'budget'    => 'required', 
 	'date_debut'    => 'required', 
 	'date_fin'    => 'required', 
 	'statut'    => 'required', 
	]);
	if ($this->sid) {
   $unprojet = Projet::find($this->sid);
	$unprojet->update([
 	'code'    => $this->code, 
 	'nom_projet'    => $this->nom_projet, 
 	'budget'    => $this->budget, 
 	'date_debut'    => $this->date_debut, 
 	'date_fin'    => $this->date_fin, 
 	'statut'    => $this->statut, 
	]);
	$this->resetProjet();
	 return redirect()->route('projet.projets');

}}

public function destroyProjet($id)
{
 if ($id) {
  	   $unprojet = Projet::find( $id);
   	 $unprojet->delete();
	}


	 return redirect()->route('projet.projets');
}

}
