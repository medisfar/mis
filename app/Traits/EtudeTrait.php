<?php
namespace App\Traits;
use Livewire\Component;
use \App\Models\Etude;
Trait EtudeTrait {
  protected $etudes,$unetude;
  public  $sid,$state='home',$search;
  public $projet_id,$categorie,$nom,$objectif,$methologie,$resultats_principaux,$reommendations_cles,$date_debut,$date_fin,$statut,$Zones,$partenaire,$lecons_apprises;

public function resetEtude() {
	 $this->projet_id  = '';
	 $this->categorie  = '';
	 $this->nom  = '';
	 $this->objectif  = '';
	 $this->methologie  = '';
	 $this->resultats_principaux  = '';
	 $this->reommendations_cles  = '';
	 $this->date_debut  = '';
	 $this->date_fin  = '';
	 $this->statut  = '';
	 $this->Zones  = '';
	 $this->partenaire  = '';
	 $this->lecons_apprises  = '';
}

public function cancelEtude() {
	 $this->state       = 'home';
}

public function createEtude() {
	 $this->state       = 'create';
 	$this->sid = null;
	$this->unetude = new Etude;
}

public function storeEtude() {
	$this->validate([
 	'projet_id'    => 'required', 
 	'categorie'    => 'required', 
 	'nom'    => 'required', 
 	'objectif'    => 'required', 
 	'methologie'    => 'required', 
 	'resultats_principaux'    => 'required', 
 	'reommendations_cles'    => 'required', 
 	'date_debut'    => 'required', 
 	'date_fin'    => 'required', 
 	'statut'    => 'required', 
 	'Zones'    => 'required', 
 	'partenaire'    => 'required', 
 	'lecons_apprises'    => 'required', 
	]);
	$unetude = new Etude;
	$unetude->create([
 	'projet_id'    => $this->projet_id, 
 	'categorie'    => $this->categorie, 
 	'nom'    => $this->nom, 
 	'objectif'    => $this->objectif, 
 	'methologie'    => $this->methologie, 
 	'resultats_principaux'    => $this->resultats_principaux, 
 	'reommendations_cles'    => $this->reommendations_cles, 
 	'date_debut'    => $this->date_debut, 
 	'date_fin'    => $this->date_fin, 
 	'statut'    => $this->statut, 
 	'Zones'    => $this->Zones, 
 	'partenaire'    => $this->partenaire, 
 	'lecons_apprises'    => $this->lecons_apprises, 
	]);
	$this->resetEtude();
	 return redirect()->route('monitoring.etudes');
}

public function showEtude($id) {
	 $this->state       = 'show';
 	$this->sid = $id;
	$this->unetude =  Etude::find($id);
 	$this->projet_id    = $this->unetude->projet_id; 
 	$this->categorie    = $this->unetude->categorie; 
 	$this->nom    = $this->unetude->nom; 
 	$this->objectif    = $this->unetude->objectif; 
 	$this->methologie    = $this->unetude->methologie; 
 	$this->resultats_principaux    = $this->unetude->resultats_principaux; 
 	$this->reommendations_cles    = $this->unetude->reommendations_cles; 
 	$this->date_debut    = $this->unetude->date_debut; 
 	$this->date_fin    = $this->unetude->date_fin; 
 	$this->statut    = $this->unetude->statut; 
 	$this->Zones    = $this->unetude->Zones; 
 	$this->partenaire    = $this->unetude->partenaire; 
 	$this->lecons_apprises    = $this->unetude->lecons_apprises; 
}

public function editEtude($id) {
	 $this->state       = 'edit';
 	$this->sid = $id;
	$this->unetude =  Etude::find($id);
if($this->unetude != null) {
 	$this->projet_id    = $this->unetude->projet_id; 
 	$this->categorie    = $this->unetude->categorie; 
 	$this->nom    = $this->unetude->nom; 
 	$this->objectif    = $this->unetude->objectif; 
 	$this->methologie    = $this->unetude->methologie; 
 	$this->resultats_principaux    = $this->unetude->resultats_principaux; 
 	$this->reommendations_cles    = $this->unetude->reommendations_cles; 
 	$this->date_debut    = $this->unetude->date_debut; 
 	$this->date_fin    = $this->unetude->date_fin; 
 	$this->statut    = $this->unetude->statut; 
 	$this->Zones    = $this->unetude->Zones; 
 	$this->partenaire    = $this->unetude->partenaire; 
 	$this->lecons_apprises    = $this->unetude->lecons_apprises; 
}}

public function updateEtude() {
	$this->validate([
 	'projet_id'    => 'required', 
 	'categorie'    => 'required', 
 	'nom'    => 'required', 
 	'objectif'    => 'required', 
 	'methologie'    => 'required', 
 	'resultats_principaux'    => 'required', 
 	'reommendations_cles'    => 'required', 
 	'date_debut'    => 'required', 
 	'date_fin'    => 'required', 
 	'statut'    => 'required', 
 	'Zones'    => 'required', 
 	'partenaire'    => 'required', 
 	'lecons_apprises'    => 'required', 
	]);
	if ($this->sid) {
   $unetude = Etude::find($this->sid);
	$unetude->update([
 	'projet_id'    => $this->projet_id, 
 	'categorie'    => $this->categorie, 
 	'nom'    => $this->nom, 
 	'objectif'    => $this->objectif, 
 	'methologie'    => $this->methologie, 
 	'resultats_principaux'    => $this->resultats_principaux, 
 	'reommendations_cles'    => $this->reommendations_cles, 
 	'date_debut'    => $this->date_debut, 
 	'date_fin'    => $this->date_fin, 
 	'statut'    => $this->statut, 
 	'Zones'    => $this->Zones, 
 	'partenaire'    => $this->partenaire, 
 	'lecons_apprises'    => $this->lecons_apprises, 
	]);
	$this->resetEtude();
	 return redirect()->route('monitoring.etudes');

}}

public function destroyEtude($id)
{
 if ($id) {
  	   $unetude = Etude::find( $id);
   	 $unetude->delete();
	}


	 return redirect()->route('monitoring.etudes');
}

}
