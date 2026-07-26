<?php
namespace App\Traits;
use Livewire\Component;
use \App\Models\Collecte;
Trait CollecteTrait {
  protected $collectes,$uncollecte;
  public  $sid,$state='home',$search;
  public $projet_id,$site_id,$groupement_id,$membre_id;

public $localite_id;
public function resetCollecte() {
	 $this->projet_id  = '';
	 $this->site_id  = '';
}

public function cancelCollecte() {
	 $this->state       = 'home';
}

public function createCollecte() {
	 $this->state       = 'create';
 	$this->sid = null;
	$this->uncollecte = new Collecte;
}

public function storeCollecte() {
	$this->validate([
 	'projet_id'    => 'required', 
 	'site_id'    => 'required', 
	]);
	$uncollecte = new Collecte;
	$uncollecte->create([
 	'projet_id'    => $this->projet_id, 
 	'site_id'    => $this->site_id, 
	]);
	$this->resetCollecte();
	 return redirect()->route('datacollect.collectes');
}

public function showCollecte($id) {
	 $this->state       = 'show';
 	$this->sid = $id;
	$this->uncollecte =  Collecte::find($id);
 	$this->projet_id    = $this->uncollecte->projet_id; 
 	$this->site_id    = $this->uncollecte->site_id; 
}

public function editCollecte($id) {
	 $this->state       = 'edit';
 	$this->sid = $id;
	$this->uncollecte =  Collecte::find($id);
if($this->uncollecte != null) {
 	$this->projet_id    = $this->uncollecte->projet_id; 
 	$this->site_id    = $this->uncollecte->site_id; 
}}

public function updateCollecte() {
	$this->validate([
 	'projet_id'    => 'required', 
 	'site_id'    => 'required', 
	]);
	if ($this->sid) {
   $uncollecte = Collecte::find($this->sid);
	$uncollecte->update([
 	'projet_id'    => $this->projet_id, 
 	'site_id'    => $this->site_id, 
	]);
	$this->resetCollecte();
	 return redirect()->route('datacollect.collectes');

}}

public function destroyCollecte($id)
{
 if ($id) {
  	   $uncollecte = Collecte::find( $id);
   	 $uncollecte->delete();
	}


	 return redirect()->route('datacollect.collectes');
}

}
