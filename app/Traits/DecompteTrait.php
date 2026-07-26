<?php
namespace App\Traits;
use Livewire\Component;
use \App\Models\Decompte;
Trait DecompteTrait {
  protected $decomptes,$undecompte;
  public  $sid,$state='home',$search;
  public $pid,$cpid,$tache,$activite_id,$site_id,$montant,$date_effective,$pid1,$tache_id,$libelle;

public function resetDecompte() {
	 $this->activite_id  = '';
	 $this->site_id  = '';
	 $this->tache_id  = '';
	  $this->libelle  = '';
	 $this->montant  = '';
	 $this->date_effective  = '';
}

public function cancelDecompte() {
	 $this->state       = 'home';
}

public function createDecompte() {
	 $this->state       = 'create';
 	$this->sid = null;
	$this->undecompte = new Decompte;
}

public function storeDecompte() {
	$this->validate([
 	'activite_id'    => 'required', 
 	
 	'libelle'=> 'required',
 	'montant'    => 'required', 
 	'date_effective'    => 'required', 
	]);
	$undecompte = new Decompte;
	$undecompte->create([
 	'activite_id'    => $this->activite_id, 
 	'site_id'    => $this->site_id, 
 	'tache_id'    => $this->tache_id, 
 	'libelle'    => $this->libelle, 
 	'montant'    => $this->montant, 
 	'date_effective'    => $this->date_effective, 
	]);
	$this->resetDecompte();
	$this->dispatch('decompteUpdate');
  $this->dispatch('hide-modal');
}

public function showDecompte($id) {
	 $this->state       = 'show';
 	$this->sid = $id;
	$this->undecompte =  Decompte::find($id);
 	$this->activite_id    = $this->undecompte->activite_id; 
 	$this->site_id    = $this->undecompte->site_id; 
 	$this->tache_id    = $this->undecompte->tache_id;
 	$this->libelle    = $this->undecompte->libelle;
 	$this->montant    = $this->undecompte->montant; 
 	$this->date_effective    = $this->undecompte->date_effective; 
}

public function editDecompte($id) {
	 $this->state       = 'edit';
 	$this->sid = $id;
	$this->undecompte =  Decompte::find($id);
if($this->undecompte != null) {
 	$this->activite_id    = $this->undecompte->activite_id; 
 	$this->site_id    = $this->undecompte->site_id; 
 	$this->tache_id    = $this->undecompte->tache_id;
 	$this->libelle    = $this->undecompte->libelle;
 	$this->montant    = $this->undecompte->montant;  
 
 	$this->date_effective    = $this->undecompte->date_effective; 
}}

public function updateDecompte() {
	$this->validate([
 	'activite_id'    => 'required', 
 	
 	'libelle'=> 'required',
 	'montant'    => 'required', 
 	'date_effective'    => 'required', 
	]);
	if ($this->sid) {
   $undecompte = Decompte::find($this->sid);
	$undecompte->update([
 	'activite_id'    => $this->activite_id, 
 	'site_id'    => $this->site_id, 
 	'tache_id'    => $this->tache_id, 
 	'montant'    => $this->montant, 
 	'libelle'    => $this->libelle,
 	'date_effective'    => $this->date_effective, 
	]);
	$this->resetDecompte();
	$this->dispatch('decompteUpdate');
  $this->dispatch('hide-modal');
}}

public function destroyDecompte($id)
{
 if ($id) {
  	   $undecompte = Decompte::find( $id);
   	 $undecompte->delete();
	}


	
}

}
