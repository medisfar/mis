<?php
namespace App\Traits;
use Livewire\Component;
use \App\Models\Bailleur;
Trait BailleurTrait {
  protected $bailleurs,$unbailleur;
  public  $sid,$state='home',$search;
  public $code,$nom_bailleur;

public function resetBailleur() {
	 $this->code  = '';
	 $this->nom_bailleur  = '';
}

public function cancelBailleur() {
	 $this->state       = 'home';
}

public function createBailleur() {
	 $this->state       = 'create';
 	$this->sid = null;
	$this->unbailleur = new Bailleur;
}

public function storeBailleur() {
	$this->validate([
 	'code'    => 'required', 
 	'nom_bailleur'    => 'required', 
	]);
	$unbailleur = new Bailleur;
	$unbailleur->create([
 	'code'    => $this->code, 
 	'nom_bailleur'    => $this->nom_bailleur, 
	]);
	$this->resetBailleur();
	 return redirect()->route('projet.bailleurs');
}

public function showBailleur($id) {
	 $this->state       = 'show';
 	$this->sid = $id;
	$this->unbailleur =  Bailleur::find($id);
 	$this->code    = $this->unbailleur->code; 
 	$this->nom_bailleur    = $this->unbailleur->nom_bailleur; 
}

public function editBailleur($id) {
	 $this->state       = 'edit';
 	$this->sid = $id;
	$this->unbailleur =  Bailleur::find($id);
if($this->unbailleur != null) {
 	$this->code    = $this->unbailleur->code; 
 	$this->nom_bailleur    = $this->unbailleur->nom_bailleur; 
}}

public function updateBailleur() {
	$this->validate([
 	'code'    => 'required', 
 	'nom_bailleur'    => 'required', 
	]);
	if ($this->sid) {
   $unbailleur = Bailleur::find($this->sid);
	$unbailleur->update([
 	'code'    => $this->code, 
 	'nom_bailleur'    => $this->nom_bailleur, 
	]);
	$this->resetBailleur();
	 return redirect()->route('projet.bailleurs');

}}

public function destroyBailleur($id)
{
 if ($id) {
  	   $unbailleur = Bailleur::find( $id);
   	 $unbailleur->delete();
	}


	 return redirect()->route('projet.bailleurs');
}

}
