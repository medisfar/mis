<?php
namespace App\Traits;
use Livewire\Component;
use \App\Models\Localite;
Trait LocaliteTrait {
  protected $localites,$unlocalite;
  public  $sid,$state='home',$search;
  public $nom_localite,$ssprefecture_id,$l_type;

public function resetLocalite() {
	 $this->nom_localite  = '';
	 $this->ssprefecture_id  = '';
	 $this->l_type  = '';
}

public function cancelLocalite() {
	 $this->state       = 'home';
}

public function createLocalite() {
	 $this->state       = 'create';
 	$this->sid = null;
	$this->unlocalite = new Localite;
}

public function storeLocalite() {
	$this->validate([
 	'nom_localite'    => 'required', 
 	'ssprefecture_id'    => 'required', 
 	'l_type'    => 'required', 
	]);
	$unlocalite = new Localite;
	$unlocalite->create([
 	'nom_localite'    => $this->nom_localite, 
 	'ssprefecture_id'    => $this->ssprefecture_id, 
 	'l_type'    => $this->l_type, 
	]);
	$this->resetLocalite();
	$this->dispatch('localiteUpdate');
$this->dispatch('hide-modal');
}

public function showLocalite($id) {
	 $this->state       = 'show';
 	$this->sid = $id;
	$this->unlocalite =  Localite::find($id);
 	$this->nom_localite    = $this->unlocalite->nom_localite; 
 	$this->ssprefecture_id    = $this->unlocalite->ssprefecture_id; 
 	$this->l_type    = $this->unlocalite->l_type; 
}

public function editLocalite($id) {
	 $this->state       = 'edit';
 	$this->sid = $id;
	$this->unlocalite =  Localite::find($id);
if($this->unlocalite != null) {
 	$this->nom_localite    = $this->unlocalite->nom_localite; 
 	$this->ssprefecture_id    = $this->unlocalite->ssprefecture_id; 
 	$this->l_type    = $this->unlocalite->l_type; 
}}

public function updateLocalite() {
	$this->validate([
 	'nom_localite'    => 'required', 
 	'ssprefecture_id'    => 'required', 
 	'l_type'    => 'required', 
	]);
	if ($this->sid) {
   $unlocalite = Localite::find($this->sid);
	$unlocalite->update([
 	'nom_localite'    => $this->nom_localite, 
 	'ssprefecture_id'    => $this->ssprefecture_id, 
 	'l_type'    => $this->l_type, 
	]);
	$this->resetLocalite();
	 $this->dispatch('localiteUpdate');
$this->dispatch('hide-modal');

}}

public function destroyLocalite($id)
{
 if ($id) {
  	   $unlocalite = Localite::find( $id);
   	 $unlocalite->delete();
   	 $this->dispatch('localiteUpdate');
$this->dispatch('hide-modal');
	}
}

}
