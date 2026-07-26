<?php
namespace App\Traits;
use Livewire\Component;
use \App\Models\Typesession;
Trait TypesessionTrait {
  protected $typesessions,$untypesession;
  public  $sid,$state='home',$search;
  public $nom;

public function resetTypesession() {
	 $this->nom  = '';
}

public function cancelTypesession() {
	 $this->state       = 'home';
}

public function createTypesession() {
	 $this->state       = 'create';
 	$this->sid = null;
	$this->untypesession = new Typesession;
}

public function storeTypesession() {
	$this->validate([
 	'nom'    => 'required', 
	]);
	$untypesession = new Typesession;
	$untypesession->create([
 	'nom'    => $this->nom, 
	]);
	$this->resetTypesession();
	 return redirect()->route('projet.typesessions');
}

public function showTypesession($id) {
	 $this->state       = 'show';
 	$this->sid = $id;
	$this->untypesession =  Typesession::find($id);
 	$this->nom    = $this->untypesession->nom; 
}

public function editTypesession($id) {
	 $this->state       = 'edit';
 	$this->sid = $id;
	$this->untypesession =  Typesession::find($id);
if($this->untypesession != null) {
 	$this->nom    = $this->untypesession->nom; 
}}

public function updateTypesession() {
	$this->validate([
 	'nom'    => 'required', 
	]);
	if ($this->sid) {
   $untypesession = Typesession::find($this->sid);
	$untypesession->update([
 	'nom'    => $this->nom, 
	]);
	$this->resetTypesession();
	 return redirect()->route('projet.typesessions');

}}

public function destroyTypesession($id)
{
 if ($id) {
  	   $untypesession = Typesession::find( $id);
   	 $untypesession->delete();
	}


	 return redirect()->route('projet.typesessions');
}

}
