<?php
namespace App\Traits;
use Livewire\Component;
use \App\Models\Membre;
Trait MembreTrait {
  protected $membres,$unmembre;
  public  $sid,$state='home',$search;
  public $menage_id,$genre,$nom,$date_naissance,$lien_parente,$enceinte;

public function resetMembre() {
	 $this->menage_id  = '';
	 $this->genre  = '';
	 $this->nom  = '';
	 $this->date_naissance  = '';
	 $this->lien_parente  = '';
	 $this->enceinte  = '';
}

public function cancelMembre() {
	 $this->state       = 'home';
}

public function createMembre() {
	 $this->state       = 'create';
 	$this->sid = null;
	$this->unmembre = new Membre;
}

public function storeMembre() {
	$this->validate([
 	'menage_id'    => 'required', 
 	'genre'    => 'required', 
 	'nom'    => 'required', 
 	'date_naissance'    => 'required', 
 	'lien_parente'    => 'required', 
 	//'enceinte'    => 'required', 
	]);
	$unmembre = new Membre;
	$a=$unmembre->create([
 	'menage_id'    => $this->menage_id, 
 	'genre'    => $this->genre, 
 	'nom'    => $this->nom, 
 	'date_naissance'    => $this->date_naissance, 
 	'lien_parente'    => $this->lien_parente, 
//	'enceinte'    => $this->enceinte, 
	]);
	$this->resetMembre();
		  $this->dispatch('ShowUpdate');
   $this->dispatch('hide-modal');
}

public function showMembre($id) {
	 $this->state       = 'show';
 	$this->sid = $id;
	$this->unmembre =  Membre::find($id);
 	$this->menage_id    = $this->unmembre->menage_id; 
 	$this->genre    = $this->unmembre->genre; 
 	$this->nom    = $this->unmembre->nom; 
 	$this->date_naissance    = $this->unmembre->date_naissance; 
 	$this->lien_parente    = $this->unmembre->lien_parente; 
 	$this->enceinte    = $this->unmembre->enceinte; 
}

public function editMembre($id) {
	 $this->state       = 'edit';
 	$this->sid = $id;
	$this->unmembre =  Membre::find($id);
if($this->unmembre != null) {
 	$this->menage_id    = $this->unmembre->menage_id; 
 	$this->genre    = $this->unmembre->genre; 
 	$this->nom    = $this->unmembre->nom; 
 	$this->date_naissance    = $this->unmembre->date_naissance; 
 	$this->lien_parente    = $this->unmembre->lien_parente; 
 	$this->enceinte    = $this->unmembre->enceinte; 
}}

public function updateMembre() {
	$this->validate([
 	'menage_id'    => 'required', 
 	'genre'    => 'required', 
 	'nom'    => 'required', 
 	'date_naissance'    => 'required', 
 	'lien_parente'    => 'required', 
 	'enceinte'    => 'required', 
	]);
	if ($this->sid) {
   $unmembre = Membre::find($this->sid);
	$unmembre->update([
 	'menage_id'    => $this->menage_id, 
 	'genre'    => $this->genre, 
 	'nom'    => $this->nom, 
 	'date_naissance'    => $this->date_naissance, 
 	'lien_parente'    => $this->lien_parente, 
 	'enceinte'    => $this->enceinte, 
	]);
	$this->resetMembre();
	return redirect()->route('beneficiaire.menages.show',$unmembre->menage_id);

}}

public function destroyMembre($id)
{
 if ($id) {
  	   $unmembre = Membre::find( $id);
   	 $unmembre->delete();
	}


	 return redirect()->route('beneficiaire.membres');
}

}
