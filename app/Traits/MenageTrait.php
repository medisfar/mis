<?php
namespace App\Traits;
use Livewire\Component;
use \App\Models\Menage;
Trait MenageTrait {
  protected $menages,$unmenage;
  public  $sid,$state='home',$search;
  public $localite_id,$toit_id,$chef,$conjoint,$tel1,$tel2;

public function resetMenage() {
	 $this->localite_id  = '';
	 $this->toit_id  = '';
	 $this->chef  = '';
	 $this->conjoint  = '';
	 $this->tel1  = '';
	 $this->tel2  = '';
}

public function cancelMenage() {
	 $this->state       = 'home';
}

public function createMenage() {
	 $this->state       = 'create';
 	$this->sid = null;
	$this->unmenage = new Menage;
}

public function storeMenage() {
	$projetId = session()->get('pid');

	if (!$projetId) {
		$this->addError('projet_id', 'Aucun projet courant sélectionné.');
		return;
	}

	$this->validate([
 	'localite_id'    => 'required', 
 	//'toit_id'    => 'required', 
 	'chef'    => 'required', 
 	'conjoint'    => 'required', 
 	//'tel1'    => 'required', 
 	//'tel2'    => 'required', 
	]);
	$unmenage = Menage::create([
 	'localite_id'    => $this->localite_id, 
 	'toit_id'    => $this->toit_id, 
 	'chef'    => $this->chef, 
 	'conjoint'    => $this->conjoint, 
 	'tel1'    => $this->tel1, 
 	'tel2'    => $this->tel2, 
	]);
	$unmenage->projets()->syncWithoutDetaching([$projetId]);
	$this->resetMenage();
	 return redirect()->route('datacollect.menages');
}

public function showMenage($id) {
	 $this->state       = 'show';
 	$this->sid = $id;
	$this->unmenage =  Menage::find($id);
 	$this->localite_id    = $this->unmenage->localite_id; 
 	$this->toit_id    = $this->unmenage->toit_id; 
 	$this->chef    = $this->unmenage->chef; 
 	$this->conjoint    = $this->unmenage->conjoint; 
 	$this->tel1    = $this->unmenage->tel1; 
 	$this->tel2    = $this->unmenage->tel2; 
}

public function editMenage($id) {
	 $this->state       = 'edit';
 	$this->sid = $id;
	$this->unmenage =  Menage::find($id);
if($this->unmenage != null) {
 	$this->localite_id    = $this->unmenage->localite_id; 
 	$this->toit_id    = $this->unmenage->toit_id; 
 	$this->chef    = $this->unmenage->chef; 
 	$this->conjoint    = $this->unmenage->conjoint; 
 	$this->tel1    = $this->unmenage->tel1; 
 	$this->tel2    = $this->unmenage->tel2; 
}}

public function updateMenage() {
	$this->validate([
 	'localite_id'    => 'required', 
 	//'toit_id'    => 'required', 
 	'chef'    => 'required', 
 	'conjoint'    => 'required', 
 	//'tel1'    => 'required', 
 	//'tel2'    => 'required', 
	]);
	if ($this->sid) {
   $unmenage = Menage::find($this->sid);
	$unmenage->update([
 	'localite_id'    => $this->localite_id, 
 	'toit_id'    => $this->toit_id, 
 	'chef'    => $this->chef, 
 	'conjoint'    => $this->conjoint, 
 	'tel1'    => $this->tel1, 
 	'tel2'    => $this->tel2, 
	]);
	$this->resetMenage();
	 return redirect()->route('datacollect.menages');

}}

public function destroyMenage($id)
{
 if ($id) {
  	   $unmenage = Menage::find( $id);
   	 $unmenage->delete();
	}


	 return redirect()->route('datacollect.menages');
}

}
