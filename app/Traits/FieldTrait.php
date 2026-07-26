<?php
namespace App\Traits;
use Livewire\Component;
use \App\Models\Field;
Trait FieldTrait {
  protected $fields,$unfield;
  public  $sid,$state='home',$search;
  public $nom,$psession_id,$row,$col,$options;

public function resetField() {
	 $this->nom  = '';
	 $this->psession_id  = '';
	 $this->row  = '';
	 $this->col  = '';
	 $this->options  = '';
}

public function cancelField() {
	 $this->state       = 'home';
}

public function createField() {
	 $this->state       = 'create';
 	$this->sid = null;
	$this->unfield = new Field;
}

public function storeField() {
	$this->validate([
 	'nom'    => 'required', 
 	'psession_id'    => 'required', 
 	'row'    => 'required', 
 	'col'    => 'required', 
 	'options'    => 'required', 
	]);
	$unfield = new Field;
	$unfield->create([
 	'nom'    => $this->nom, 
 	'psession_id'    => $this->psession_id, 
 	'row'    => $this->row, 
 	'col'    => $this->col, 
 	'options'    => $this->options, 
	]);
	$this->resetField();
	 return redirect()->route('datacollect.fields');
}

public function showField($id) {
	 $this->state       = 'show';
 	$this->sid = $id;
	$this->unfield =  Field::find($id);
 	$this->nom    = $this->unfield->nom; 
 	$this->psession_id    = $this->unfield->psession_id; 
 	$this->row    = $this->unfield->row; 
 	$this->col    = $this->unfield->col; 
 	$this->options    = $this->unfield->options; 
}

public function editField($id) {
	 $this->state       = 'edit';
 	$this->sid = $id;
	$this->unfield =  Field::find($id);
if($this->unfield != null) {
 	$this->nom    = $this->unfield->nom; 
 	$this->psession_id    = $this->unfield->psession_id; 
 	$this->row    = $this->unfield->row; 
 	$this->col    = $this->unfield->col; 
 	$this->options    = $this->unfield->options; 
}}

public function updateField() {
	$this->validate([
 	'nom'    => 'required', 
 	'psession_id'    => 'required', 
 	'row'    => 'required', 
 	'col'    => 'required', 
 	'options'    => 'required', 
	]);
	if ($this->sid) {
   $unfield = Field::find($this->sid);
	$unfield->update([
 	'nom'    => $this->nom, 
 	'psession_id'    => $this->psession_id, 
 	'row'    => $this->row, 
 	'col'    => $this->col, 
 	'options'    => $this->options, 
	]);
	$this->resetField();
	 return redirect()->route('datacollect.fields');

}}

public function destroyField($id)
{
 if ($id) {
  	   $unfield = Field::find( $id);
   	 $unfield->delete();
	}


	 return redirect()->route('datacollect.fields');
}

}
