<?php
namespace App\Traits;
use Livewire\Component;
use \App\Models\Lessession;
Trait LessessionTrait {
  protected $lessessions,$unlessession;
  public  $sid,$state='home',$search;
  public $site_id,$date_session,$groupement_id,$typesession_id;

public function resetLessession() {
	
	 $this->site_id  = '';
	 $this->date_session  = '';
	 $this->groupement_id  = '';
}

public function cancelLessession() {
	 $this->state       = 'home';
}

public function createLessession() {
	 $this->state       = 'create';
 	$this->sid = null;
	$this->unlessession = new Lessession;
}

public function storeLessession() {
	$this->validate([
 	
 	'site_id'    => 'required', 
 	
 	'date_session'    => 'required', 
 	'groupement_id'    => 'required', 
	]);
	$unlessession = new Lessession;
	$d=[
 	
 	'site_id'    => $this->site_id, 
 	'typesession_id'    => $this->typesession_id,
 	'date_session'    => $this->date_session, 
 	'groupement_id'    => $this->groupement_id, 
	];

	$unlessession->create($d);
	$this->resetLessession();
	 return redirect()->route('datacollect.lessessions');
}

public function showLessession($id) {
	 $this->state       = 'show';
 	$this->sid = $id;
	$this->unlessession =  Lessession::find($id);
 	 
 	$this->site_id    = $this->unlessession->site_id; 
 	$this->date_session    = $this->unlessession->date_session; 
 	$this->groupement_id    = $this->unlessession->groupement_id; 
}

public function editLessession($id) {
	 $this->state       = 'edit';
 	$this->sid = $id;
	$this->unlessession =  Lessession::find($id);
if($this->unlessession != null) {
 
 	$this->site_id    = $this->unlessession->site_id; 
 	$this->date_session    = $this->unlessession->date_session; 
 	$this->groupement_id    = $this->unlessession->groupement_id; 
}}

public function updateLessession() {
   
	$this->validate([
 	
 	'site_id'    => 'required', 
 	'date_session'    => 'required', 
 	'groupement_id'    => 'required', 
	]);
	if ($this->sid) {
   $unlessession = Lessession::find($this->sid);
   $d=[
 	
 	'site_id'    => $this->site_id, 
 	'typesession_id'    => (int)$this->typesession_id,
 	'date_session'    => $this->date_session, 
 	'groupement_id'    => $this->groupement_id, 
	];
	//dd($d);
	$unlessession->update($d);
	$this->resetLessession();
	 return redirect()->route('datacollect.lessessions');

}}

public function destroyLessession($id)
{
 if ($id) {
  	   $unlessession = Lessession::find( $id);
   	 $unlessession->delete();
	}


	 return redirect()->route('datacollect.lessessions');
}

}
