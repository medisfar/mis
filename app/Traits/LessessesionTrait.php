<?php
namespace App\Traits;
use Livewire\Component;
use \App\Models\Lessessesion;
Trait LessessesionTrait {
  protected $lessessions,$unlessessesion;
  public  $sid,$state='home',$search;
  public $site_id,$date_session,$groupement_id;

public function resetLessessesion() {
	 $this->site_id  = '';
	 $this->date_session  = '';
	 $this->groupement_id  = '';
}

public function cancelLessessesion() {
	 $this->state       = 'home';
}

public function createLessessesion() {
	 $this->state       = 'create';
 	$this->sid = null;
	$this->unlessessesion = new Lessessesion;
}

public function storeLessessesion() {
	$this->validate([
 	'site_id'    => 'required', 
 	'date_session'    => 'required', 
 	'groupement_id'    => 'required', 
	]);
	$unlessessesion = new Lessessesion;
	$unlessessesion->create([
 	'site_id'    => $this->site_id, 
 	'date_session'    => $this->date_session, 
 	'groupement_id'    => $this->groupement_id, 
	]);
	$this->resetLessessesion();
	 return redirect()->route('monitoring.lessessions');
}

public function showLessessesion($id) {
	 $this->state       = 'show';
 	$this->sid = $id;
	$this->unlessessesion =  Lessessesion::find($id);
 	$this->site_id    = $this->unlessessesion->site_id; 
 	$this->date_session    = $this->unlessessesion->date_session; 
 	$this->groupement_id    = $this->unlessessesion->groupement_id; 
}

public function editLessessesion($id) {
	 $this->state       = 'edit';
 	$this->sid = $id;
	$this->unlessessesion =  Lessessesion::find($id);
if($this->unlessessesion != null) {
 	$this->site_id    = $this->unlessessesion->site_id; 
 	$this->date_session    = $this->unlessessesion->date_session; 
 	$this->groupement_id    = $this->unlessessesion->groupement_id; 
}}

public function updateLessessesion() {
	$this->validate([
 	'site_id'    => 'required', 
 	'date_session'    => 'required', 
 	'groupement_id'    => 'required', 
	]);
	if ($this->sid) {
   $unlessessesion = Lessessesion::find($this->sid);
	$unlessessesion->update([
 	'site_id'    => $this->site_id, 
 	'date_session'    => $this->date_session, 
 	'groupement_id'    => $this->groupement_id, 
	]);
	$this->resetLessessesion();
	 return redirect()->route('monitoring.lessessions');

}}

public function destroyLessessesion($id)
{
 if ($id) {
  	   $unlessessesion = Lessessesion::find( $id);
   	 $unlessessesion->delete();
	}


	 return redirect()->route('monitoring.lessessions');
}

}
