<?php
namespace App\Traits;
use Livewire\Component;
use \App\Models\Periode;
Trait PeriodeTrait {
  protected $periodes,$unperiode;
  public  $sid,$state='home',$search;
  public $indicateur_id,$date_debut,$date_fin,$cible;

public function resetPeriode() {
	 //$this->activite_id  = '';
	 $this->indicateur_id  = '';
	 $this->date_debut  = '';
	 $this->date_fin  = '';
	 $this->cible  = '';
}

public function cancelPeriode() {
	 $this->state       = 'home';
}

public function createPeriode() {
	 $this->state       = 'create';
 	$this->sid = null;
	$this->unperiode = new Periode;
}

public function storePeriode() {
	$this->validate([
 	//'activite_id'    => 'required', 
 	'indicateur_id'    => 'required', 
 	'date_debut'    => 'required', 
 	'date_fin'    => 'required', 
 	'cible'    => 'required', 
	]);
	$unperiode = new Periode;
	$unperiode->create([
 	//'activite_id'    => $this->activite_id, 
 	'indicateur_id'    => $this->indicateur_id, 
 	'date_debut'    => $this->date_debut, 
 	'date_fin'    => $this->date_fin, 
 	'cible'    => $this->cible, 
	]);
	$this->resetPeriode();
	 return redirect()->route('monitoring.periodes');
}

public function showPeriode($id) {
	 $this->state       = 'show';
 	$this->sid = $id;
	$this->unperiode =  Periode::find($id);
 //	$this->activite_id    = $this->unperiode->activite_id; 
 	$this->indicateur_id    = $this->unperiode->indicateur_id; 
 	$this->date_debut    = $this->unperiode->date_debut; 
 	$this->date_fin    = $this->unperiode->date_fin; 
 	$this->cible    = $this->unperiode->cible; 
}

public function editPeriode($id) {
	 $this->state       = 'edit';
 	$this->sid = $id;
	$this->unperiode =  Periode::find($id);
if($this->unperiode != null) {
 //	$this->activite_id    = $this->unperiode->activite_id; 
 	$this->indicateur_id    = $this->unperiode->indicateur_id; 
 	$this->date_debut    = $this->unperiode->date_debut; 
 	$this->date_fin    = $this->unperiode->date_fin; 
 	$this->cible    = $this->unperiode->cible; 
}}

public function updatePeriode() {
	$this->validate([
 	//'activite_id'    => 'required', 
 	'indicateur_id'    => 'required', 
 	'date_debut'    => 'required', 
 	'date_fin'    => 'required', 
 	'cible'    => 'required', 
	]);
	if ($this->sid) {
   $unperiode = Periode::find($this->sid);
	$unperiode->update([
 //	'activite_id'    => $this->activite_id, 
 	'indicateur_id'    => $this->indicateur_id, 
 	'date_debut'    => $this->date_debut, 
 	'date_fin'    => $this->date_fin, 
 	'cible'    => $this->cible, 
	]);
	$this->resetPeriode();
	 return redirect()->route('monitoring.periodes');

}}

public function destroyPeriode($id)
{
 if ($id) {
  	   $unperiode = Periode::find( $id);
   	 $unperiode->delete();
	}


	 return redirect()->route('monitoring.periodes');
}

}
