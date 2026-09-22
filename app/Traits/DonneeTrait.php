<?php
namespace App\Traits;
use Livewire\Component;
use \App\Models\Donnee;
Trait DonneeTrait {
  protected $donnees,$undonnee;
  public  $sid,$state='home',$search;
  public $site_id,$groupement_id,$session_id,$membre_id,$metadonnees;

public function resetDonnee() {
	 $this->site_id  = '';
	 $this->groupement_id  = '';
	 $this->session_id  = '';
	 $this->membre_id  = '';
	 $this->metadonnees  = '';
}

public function cancelDonnee() {
	 $this->state       = 'home';
}

public function createDonnee() {
	 $this->state       = 'create';
 	$this->sid = null;
	$this->undonnee = new Donnee;
}

public function storeDonnee() {
	$this->validate([
 	'site_id'    => 'required', 
 	'groupement_id'    => 'required', 
 	'session_id'    => 'required', 
 	'membre_id'    => 'required', 
 	'metadonnees'    => 'required', 
	]);
	$undonnee = new Donnee;
	$undonnee->create([
 	'site_id'    => $this->site_id, 
 	'groupement_id'    => $this->groupement_id, 
 	'session_id'    => $this->session_id, 
 	'membre_id'    => $this->membre_id, 
 	'metadonnees'    => $this->metadonnees, 
	]);
	$this->resetDonnee();
	 return redirect()->route('datacollect.donnees');
}

public function showDonnee($id) {
	 $this->state       = 'show';
 	$this->sid = $id;
	$this->undonnee =  Donnee::find($id);
 	$this->site_id    = $this->undonnee->site_id; 
 	$this->groupement_id    = $this->undonnee->groupement_id; 
 	$this->session_id    = $this->undonnee->session_id; 
 	$this->membre_id    = $this->undonnee->membre_id; 
 	$this->metadonnees    = $this->undonnee->metadonnees; 
}

public function editDonnee($id) {
	 $this->state       = 'edit';
 	$this->sid = $id;
	$this->undonnee =  Donnee::find($id);
if($this->undonnee != null) {
 	$this->site_id    = $this->undonnee->site_id; 
 	$this->groupement_id    = $this->undonnee->groupement_id; 
 	$this->session_id    = $this->undonnee->session_id; 
 	$this->membre_id    = $this->undonnee->membre_id; 
 	$this->metadonnees    = $this->undonnee->metadonnees; 
}}

public function updateDonnee() {
	$this->validate([
 	'site_id'    => 'required', 
 	'groupement_id'    => 'required', 
 	'session_id'    => 'required', 
 	'membre_id'    => 'required', 
 	'metadonnees'    => 'required', 
	]);
	if ($this->sid) {
   $undonnee = Donnee::find($this->sid);
	$undonnee->update([
 	'site_id'    => $this->site_id, 
 	'groupement_id'    => $this->groupement_id, 
 	'session_id'    => $this->session_id, 
 	'membre_id'    => $this->membre_id, 
 	'metadonnees'    => $this->metadonnees, 
	]);
	$this->resetDonnee();
	 return redirect()->route('datacollect.donnees');

}}

public function destroyDonnee($id)
{
 if ($id) {
  	   $undonnee = Donnee::find( $id);
   	 $undonnee->delete();
	}


	 return redirect()->route('datacollect.donnees');
}

}
