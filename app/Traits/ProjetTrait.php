<?php
namespace App\Traits;
use Livewire\Component;
use \App\Models\Projet;
Trait ProjetTrait {
  protected $projets,$unprojet;
  public  $sid,$state='home',$search;
  public $code,$libelle,$nom_projet,$objectifs,$budget,$date_debut,$date_fin,$l_statut,$commentaire;

public function resetProjet() {
	 $this->code  = '';
	 $this->libelle  = '';
	 $this->nom_projet  = '';
	 $this->objectifs  = '';
	 $this->budget  = '';
	 $this->date_debut  = '';
	 $this->date_fin  = '';
	 $this->l_statut  = '';
	 $this->commentaire  = '';
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
 	'libelle'    => 'required', 
 	'nom_projet'    => 'required', 
 	'objectifs'    => 'required', 
 	'budget'    => 'required', 
 	'date_debut'    => 'required', 
 	'date_fin'    => 'required', 
 	'l_statut'    => 'required', 
 //	'commentaire'    => 'required', 
	]);
	$unprojet = new Projet;
	$a=$unprojet->create([
 	'code'    => $this->code, 
 	'libelle'    => $this->libelle, 
 	'nom_projet'    => $this->nom_projet, 
 	'objectifs'    => $this->objectifs, 
 	'budget'    => $this->budget, 
 	'date_debut'    => $this->date_debut, 
 	'date_fin'    => $this->date_fin, 
 	'l_statut'    => $this->l_statut, 
 	//'commentaire'    => $this->commentaire, 
	]);
	$this->resetProjet();
		
   $this->dispatch('projetUpdate');
   $this->dispatch('hide-modal');
}

public function showProjet($id) {
	 $this->state       = 'show';
 	$this->sid = $id;
	$this->unprojet =  Projet::find($id);
 	$this->code    = $this->unprojet->code; 
 	$this->libelle    = $this->unprojet->libelle; 
 	$this->nom_projet    = $this->unprojet->nom_projet; 
 	$this->objectifs    = $this->unprojet->objectifs; 
 	$this->budget    = $this->unprojet->budget; 
 	$this->date_debut    = $this->unprojet->date_debut; 
 	$this->date_fin    = $this->unprojet->date_fin; 
 	$this->l_statut    = $this->unprojet->l_statut; 
 	$this->commentaire    = $this->unprojet->commentaire; 
}

public function editProjet($id) {
	 $this->state       = 'edit';
 	$this->sid = $id;
	$this->unprojet =  Projet::find($id);
if($this->unprojet != null) {
 	$this->code    = $this->unprojet->code; 
 	$this->libelle    = $this->unprojet->libelle; 
 	$this->nom_projet    = $this->unprojet->nom_projet; 
 	$this->objectifs    = $this->unprojet->objectifs; 
 	$this->budget    = $this->unprojet->budget; 
 	$this->date_debut    = $this->unprojet->date_debut; 
 	$this->date_fin    = $this->unprojet->date_fin; 
 	$this->l_statut    = $this->unprojet->l_statut; 
 	$this->commentaire    = $this->unprojet->commentaire; 
}}

public function updateProjet() {
	$this->validate([
 	'code'    => 'required', 
 	'libelle'    => 'required', 
 	'nom_projet'    => 'required', 
 	'objectifs'    => 'required', 
 	'budget'    => 'required', 
 	'date_debut'    => 'required', 
 	'date_fin'    => 'required', 
 	'l_statut'    => 'required', 
 	'commentaire'    => 'required', 
	]);
	if ($this->sid) {
   $unprojet = Projet::find($this->sid);
	$unprojet->update([
 	'code'    => $this->code, 
 	'libelle'    => $this->libelle, 
 	'nom_projet'    => $this->nom_projet, 
 	'objectifs'    => $this->objectifs, 
 	'budget'    => $this->budget, 
 	'date_debut'    => $this->date_debut, 
 	'date_fin'    => $this->date_fin, 
 	'l_statut'    => $this->l_statut, 
 	'commentaire'    => $this->commentaire, 
	]);
	$this->resetProjet();
	 	$this->dispatch('projetUpdate');
	 		$this->dispatch('hide-modal');

}}

public function destroyProjet($id)
{
 if ($id) {
  	   $unprojet = Projet::find( $id);
  	   if($unprojet->composantes->count()==0)
   	 $unprojet->delete();
	}


	  	$this->dispatch('projetUpdate');
	  		$this->dispatch('hide-modal');
}

}
