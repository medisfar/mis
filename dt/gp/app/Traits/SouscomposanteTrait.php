<?php
namespace App\Traits;
use Livewire\Component;
use \App\Models\Souscomposante;
Trait SouscomposanteTrait {
  protected $souscomposantes,$unsouscomposante;
  public  $sid,$state='home',$search;
  public $code,$description,$composante_id;

public function resetSouscomposante() {
	 $this->code  = '';
	 $this->description  = '';
	 $this->composante_id  = '';
}

public function cancelSouscomposante() {
	 $this->state       = 'home';
}

public function createSouscomposante() {
	 $this->state       = 'create';
 	$this->sid = null;
	$this->unsouscomposante = new Souscomposante;
}

public function storeSouscomposante() {
	$this->validate([
 	'code'    => 'required', 
 	'description'    => 'required', 
 	'composante_id'    => 'required', 
	]);
	$unsouscomposante = new Souscomposante;
	$unsouscomposante->create([
 	'code'    => $this->code, 
 	'description'    => $this->description, 
 	'composante_id'    => $this->composante_id, 
	]);
	$this->resetSouscomposante();
	 return redirect()->route('projet.souscomposantes');
}

public function showSouscomposante($id) {
	 $this->state       = 'show';
 	$this->sid = $id;
	$this->unsouscomposante =  Souscomposante::find($id);
 	$this->code    = $this->unsouscomposante->code; 
 	$this->description    = $this->unsouscomposante->description; 
 	$this->composante_id    = $this->unsouscomposante->composante_id; 
}

public function editSouscomposante($id) {
	 $this->state       = 'edit';
 	$this->sid = $id;
	$this->unsouscomposante =  Souscomposante::find($id);
if($this->unsouscomposante != null) {
 	$this->code    = $this->unsouscomposante->code; 
 	$this->description    = $this->unsouscomposante->description; 
 	$this->composante_id    = $this->unsouscomposante->composante_id; 
}}

public function updateSouscomposante() {
	$this->validate([
 	'code'    => 'required', 
 	'description'    => 'required', 
 	'composante_id'    => 'required', 
	]);
	if ($this->sid) {
   $unsouscomposante = Souscomposante::find($this->sid);
	$unsouscomposante->update([
 	'code'    => $this->code, 
 	'description'    => $this->description, 
 	'composante_id'    => $this->composante_id, 
	]);
	$this->resetSouscomposante();
	 return redirect()->route('projet.souscomposantes');

}}

public function destroySouscomposante($id)
{
 if ($id) {
  	   $unsouscomposante = Souscomposante::find( $id);
   	 $unsouscomposante->delete();
	}


	 return redirect()->route('projet.souscomposantes');
}

}
