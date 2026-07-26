<?php
namespace App\Traits;
use Livewire\Component;
use \App\Models\Secteur;
Trait SecteurTrait {
  protected $secteurs,$unsecteur;
  public  $sid,$state='home',$search;
  public $nom_secteur,$mission_id;

public function resetSecteur() {
	 $this->nom_secteur  = '';
	 $this->mission_id  = '';
}

public function cancelSecteur() {
	 $this->state       = 'home';
}

public function createSecteur() {
	 $this->state       = 'create';
 	$this->sid = null;
	$this->unsecteur = new Secteur;
}

public function storeSecteur() {
	$this->validate([
 	'nom_secteur'    => 'required', 
 	'mission_id'    => 'required', 
	]);
	$unsecteur = new Secteur;
	$unsecteur->create([
 	'nom_secteur'    => $this->nom_secteur, 
 	'mission_id'    => $this->mission_id, 
	]);
	$this->resetSecteur();
	 return redirect()->route('projet.secteurs');
}

public function showSecteur($id) {
	 $this->state       = 'show';
 	$this->sid = $id;
	$this->unsecteur =  Secteur::find($id);
 	$this->nom_secteur    = $this->unsecteur->nom_secteur; 
 	$this->mission_id    = $this->unsecteur->mission_id; 
}

public function editSecteur($id) {
	 $this->state       = 'edit';
 	$this->sid = $id;
	$this->unsecteur =  Secteur::find($id);
if($this->unsecteur != null) {
 	$this->nom_secteur    = $this->unsecteur->nom_secteur; 
 	$this->mission_id    = $this->unsecteur->mission_id; 
}}

public function updateSecteur() {
	$this->validate([
 	'nom_secteur'    => 'required', 
 	'mission_id'    => 'required', 
	]);
	if ($this->sid) {
   $unsecteur = Secteur::find($this->sid);
	$unsecteur->update([
 	'nom_secteur'    => $this->nom_secteur, 
 	'mission_id'    => $this->mission_id, 
	]);
	$this->resetSecteur();
	 return redirect()->route('projet.secteurs');

}}

public function destroySecteur($id)
{
 if ($id) {
  	   $unsecteur = Secteur::find( $id);
   	 $unsecteur->delete();
	}


	 return redirect()->route('projet.secteurs');
}

}
