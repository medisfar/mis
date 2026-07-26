<?php
namespace App\Traits;
use Livewire\Component;
use \App\Models\Formulaire;
Trait FormulaireTrait {
  protected $formulaires,$unformulaire;
  public  $sid,$state='home',$search;
  public $nom,$projet_id,$fields,$actif;

public function resetFormulaire() {
	 $this->nom  = '';
	 $this->projet_id  = '';
	 $this->fields  = '';
	 $this->actif  = '';
}

public function cancelFormulaire() {
	 $this->state       = 'home';
}

public function createFormulaire() {
	 $this->state       = 'create';
 	$this->sid = null;
	$this->unformulaire = new Formulaire;
}

public function storeFormulaire() {
	$this->validate([
 	'nom'    => 'required', 
 	'projet_id'    => 'required', 
 	'fields'    => 'required', 
 	'actif'    => 'required', 
	]);
	$unformulaire = new Formulaire;
	$unformulaire->create([
 	'nom'    => $this->nom, 
 	'projet_id'    => $this->projet_id, 
 	'fields'    => $this->fields, 
 	'actif'    => $this->actif, 
	]);
	$this->resetFormulaire();
	 return redirect()->route('datacollect.formulaires');
}

public function showFormulaire($id) {
	 $this->state       = 'show';
 	$this->sid = $id;
	$this->unformulaire =  Formulaire::find($id);
 	$this->nom    = $this->unformulaire->nom; 
 	$this->projet_id    = $this->unformulaire->projet_id; 
 	$this->fields    = $this->unformulaire->fields; 
 	$this->actif    = $this->unformulaire->actif; 
}

public function editFormulaire($id) {
	 $this->state       = 'edit';
 	$this->sid = $id;
	$this->unformulaire =  Formulaire::find($id);
if($this->unformulaire != null) {
 	$this->nom    = $this->unformulaire->nom; 
 	$this->projet_id    = $this->unformulaire->projet_id; 
 	$this->fields    = $this->unformulaire->fields; 
 	$this->actif    = $this->unformulaire->actif; 
}}

public function updateFormulaire() {
	$this->validate([
 	'nom'    => 'required', 
 	'projet_id'    => 'required', 
 	'fields'    => 'required', 
 	'actif'    => 'required', 
	]);
	if ($this->sid) {
   $unformulaire = Formulaire::find($this->sid);
	$unformulaire->update([
 	'nom'    => $this->nom, 
 	'projet_id'    => $this->projet_id, 
 	'fields'    => $this->fields, 
 	'actif'    => $this->actif, 
	]);
	$this->resetFormulaire();
	 return redirect()->route('datacollect.formulaires');

}}

public function destroyFormulaire($id)
{
 if ($id) {
  	   $unformulaire = Formulaire::find( $id);
   	 $unformulaire->delete();
	}


	 return redirect()->route('datacollect.formulaires');
}

}
