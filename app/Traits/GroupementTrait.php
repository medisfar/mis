<?php
namespace App\Traits;
use Livewire\Component;
use \App\Models\Groupement;
Trait GroupementTrait {
  protected $groupements,$ungroupement;
  public  $sid,$state='home',$search;
  public $projet_id,$nom_groupe,$site_id,$statut;

public function resetGroupement() {
	 $this->projet_id  = '';
	 $this->nom_groupe  = '';
	 $this->site_id  = '';
	 $this->statut  = '';
}

public function cancelGroupement() {
	 $this->state       = 'home';
}

public function createGroupement() {
	 $this->state       = 'create';
 	$this->sid = null;
	$this->ungroupement = new Groupement;
}

public function storeGroupement() {
	$this->validate([
 	'projet_id'    => 'required', 
 	'nom_groupe'    => 'required', 
 	'site_id'    => 'required', 
 	'statut'    => 'required', 
	]);
	$ungroupement = new Groupement;
	$ungroupement->create([
 	'projet_id'    => $this->projet_id, 
 	'nom_groupe'    => $this->nom_groupe, 
 	'site_id'    => $this->site_id, 
 	'statut'    => $this->statut, 
	]);
	$this->resetGroupement();
	 return redirect()->route('datacollect.groupements');
}

public function showGroupement($id) {
	 $this->state       = 'show';
 	$this->sid = $id;
	$this->ungroupement =  Groupement::find($id);
 	$this->projet_id    = $this->ungroupement->projet_id; 
 	$this->nom_groupe    = $this->ungroupement->nom_groupe; 
 	$this->site_id    = $this->ungroupement->site_id; 
 	$this->statut    = $this->ungroupement->statut; 
}

public function editGroupement($id) {
	 $this->state       = 'edit';
 	$this->sid = $id;
	$this->ungroupement =  Groupement::find($id);
if($this->ungroupement != null) {
 	$this->projet_id    = $this->ungroupement->projet_id; 
 	$this->nom_groupe    = $this->ungroupement->nom_groupe; 
 	$this->site_id    = $this->ungroupement->site_id; 
 	$this->statut    = $this->ungroupement->statut; 
}}

public function updateGroupement() {
	$this->validate([
 	'projet_id'    => 'required', 
 	'nom_groupe'    => 'required', 
 	'site_id'    => 'required', 
 	'statut'    => 'required', 
	]);
	if ($this->sid) {
   $ungroupement = Groupement::find($this->sid);
	$ungroupement->update([
 	'projet_id'    => $this->projet_id, 
 	'nom_groupe'    => $this->nom_groupe, 
 	'site_id'    => $this->site_id, 
 	'statut'    => $this->statut, 
	]);
	$this->resetGroupement();
	 return redirect()->route('datacollect.groupements');

}}

public function destroyGroupement($id)
{
 if ($id) {
  	   $ungroupement = Groupement::find( $id);
   	 $ungroupement->delete();
	}


	 return redirect()->route('datacollect.groupements');
}

}
