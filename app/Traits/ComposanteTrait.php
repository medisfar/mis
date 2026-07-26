<?php
namespace App\Traits;
use Livewire\Component;
use \App\Models\Composante;
Trait ComposanteTrait {
  protected $composantes,$uncomposante;
  public  $sid,$state='home',$search;
  public $pid,$code,$description,$budget,$projet_id;

public function resetComposante() {
	 $this->code  = '';
	 $this->description  = '';
	 $this->projet_id  = '';
	 $this->budget  = '';
}

public function cancelComposante() {
	 $this->state       = 'home';
}

public function createComposante() {
	 $this->state       = 'create';
 	$this->sid = null;
	$this->uncomposante = new Composante;
}

public function storeComposante() {
	$this->validate([
 	'code'    => 'required', 
 	'description'    => 'required', 
 	'projet_id'    => 'required', 
 	'budget'    => 'required', 
	]);
	$uncomposante = new Composante;
	$uncomposante->create([
 	'code'    => $this->code, 
 	'description'    => $this->description, 
 	'projet_id'    => $this->projet_id, 
 	'budget'    => $this->budget, 
	]);
	$this->resetComposante();
	  $this->dispatch('composanteUpdate');
   $this->dispatch('hide-modal');
}

public function showComposante($id) {
	 $this->state       = 'show';
 	$this->sid = $id;
	$this->uncomposante =  Composante::find($id);
 	$this->code    = $this->uncomposante->code; 
 	$this->description    = $this->uncomposante->description; 
 	$this->projet_id    = $this->uncomposante->projet_id; 
 	$this->budget    = $this->uncomposante->budget; 
}

public function editComposante($id) {
	 $this->state       = 'edit';
 	$this->sid = $id;
	$this->uncomposante =  Composante::find($id);
if($this->uncomposante != null) {
 	$this->code    = $this->uncomposante->code; 
 	$this->description    = $this->uncomposante->description; 
 	$this->projet_id    = $this->uncomposante->projet_id; 
 	$this->budget    = $this->uncomposante->budget; 
}}

public function updateComposante() {
	$this->validate([
 	'code'    => 'required', 
 	'description'    => 'required', 
 	'projet_id'    => 'required', 
 	'budget'    => 'required', 
	]);
	if ($this->sid) {
   $uncomposante = Composante::find($this->sid);
	$uncomposante->update([
 	'code'    => $this->code, 
 	'description'    => $this->description, 
 	'projet_id'    => $this->projet_id, 
 	'budget'    => $this->budget, 
	]);
	$this->resetComposante();
		$this->resetComposante();
	  $this->dispatch('composanteUpdate');
	  $this->dispatch('hide-modal');

}}

public function destroyComposante($id)
{
 if ($id) {
  	   $uncomposante = Composante::find( $id);
   	 $uncomposante->delete();
	}


	 	$this->resetComposante();
	  $this->dispatch('composanteUpdate');
	  $this->dispatch('hide-modal');
}

}
