<?php
namespace App\Traits;
use Livewire\Component;
use \App\Models\Composante;
Trait ComposanteTrait {
  protected $composantes,$uncomposante;
  public  $sid,$state='home',$search;
  public $code,$description,$projet_id;

public function resetComposante() {
	 $this->code  = '';
	 $this->description  = '';
	 $this->projet_id  = '';
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
	]);
	$uncomposante = new Composante;
	$uncomposante->create([
 	'code'    => $this->code, 
 	'description'    => $this->description, 
 	'projet_id'    => $this->projet_id, 
	]);
	$this->resetComposante();
	 return redirect()->route('projet.composantes');
}

public function showComposante($id) {
	 $this->state       = 'show';
 	$this->sid = $id;
	$this->uncomposante =  Composante::find($id);
 	$this->code    = $this->uncomposante->code; 
 	$this->description    = $this->uncomposante->description; 
 	$this->projet_id    = $this->uncomposante->projet_id; 
}

public function editComposante($id) {
	 $this->state       = 'edit';
 	$this->sid = $id;
	$this->uncomposante =  Composante::find($id);
if($this->uncomposante != null) {
 	$this->code    = $this->uncomposante->code; 
 	$this->description    = $this->uncomposante->description; 
 	$this->projet_id    = $this->uncomposante->projet_id; 
}}

public function updateComposante() {
	$this->validate([
 	'code'    => 'required', 
 	'description'    => 'required', 
 	'projet_id'    => 'required', 
	]);
	if ($this->sid) {
   $uncomposante = Composante::find($this->sid);
	$uncomposante->update([
 	'code'    => $this->code, 
 	'description'    => $this->description, 
 	'projet_id'    => $this->projet_id, 
	]);
	$this->resetComposante();
	 return redirect()->route('projet.composantes');

}}

public function destroyComposante($id)
{
 if ($id) {
  	   $uncomposante = Composante::find( $id);
   	 $uncomposante->delete();
	}


	 return redirect()->route('projet.composantes');
}

}
