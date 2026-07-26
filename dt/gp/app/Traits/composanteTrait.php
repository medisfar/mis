<?php
namespace App\Traits;
use Livewire\Component;
use \App\Models\composante;
Trait composanteTrait {
  protected $composantes,$uncomposante;
  public  $sid,$state='home',$search;
  public $code,$description,$projet_id;

public function resetcomposante() {
	 $this->code  = '';
	 $this->description  = '';
	 $this->projet_id  = '';
}

public function cancelcomposante() {
	 $this->state       = 'home';
}

public function createcomposante() {
	 $this->state       = 'create';
 	$this->sid = null;
	$this->uncomposante = new composante;
}

public function storecomposante() {
	$this->validate([
 	'code'    => 'required', 
 	'description'    => 'required', 
 	'projet_id'    => 'required', 
	]);
	$uncomposante = new composante;
	$uncomposante->create([
 	'code'    => $this->code, 
 	'description'    => $this->description, 
 	'projet_id'    => $this->projet_id, 
	]);
	$this->resetcomposante();
	 return redirect()->route('projet.composantes');
}

public function showcomposante($id) {
	 $this->state       = 'show';
 	$this->sid = $id;
	$this->uncomposante =  composante::find($id);
 	$this->code    = $this->uncomposante->code; 
 	$this->description    = $this->uncomposante->description; 
 	$this->projet_id    = $this->uncomposante->projet_id; 
}

public function editcomposante($id) {
	 $this->state       = 'edit';
 	$this->sid = $id;
	$this->uncomposante =  composante::find($id);
if($this->uncomposante != null) {
 	$this->code    = $this->uncomposante->code; 
 	$this->description    = $this->uncomposante->description; 
 	$this->projet_id    = $this->uncomposante->projet_id; 
}}

public function updatecomposante() {
	$this->validate([
 	'code'    => 'required', 
 	'description'    => 'required', 
 	'projet_id'    => 'required', 
	]);
	if ($this->sid) {
   $uncomposante = composante::find($this->sid);
	$uncomposante->update([
 	'code'    => $this->code, 
 	'description'    => $this->description, 
 	'projet_id'    => $this->projet_id, 
	]);
	$this->resetcomposante();
	 return redirect()->route('projet.composantes');

}}

public function destroycomposante($id)
{
 if ($id) {
  	   $uncomposante = composante::find( $id);
   	 $uncomposante->delete();
	}


	 return redirect()->route('projet.composantes');
}

}
