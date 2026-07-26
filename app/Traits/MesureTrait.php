<?php
namespace App\Traits;
use Livewire\Component;
use \App\Models\Mesure;
Trait MesureTrait {
  protected $mesures,$unmesure;
  public  $sid,$state='home',$search;
  public $indicateur_id,$periode_id,$cible,$valeur,$statut,$commentaire;

public function resetMesure() {
	 $this->indicateur_id  = '';
	 $this->periode_id  = '';
	 $this->cible  = '';
	 $this->valeur  = '';
	 $this->statut  = '';
	 $this->commentaire  = '';
}

public function cancelMesure() {
	 $this->state       = 'home';
}

public function createMesure() {
	 $this->state       = 'create';
 	$this->sid = null;
	$this->unmesure = new Mesure;
}

public function storeMesure() {
	$this->validate([
 	'indicateur_id'    => 'required', 
 	'periode_id'    => 'required', 
 	'cible'    => 'required', 
 	'valeur'    => 'required', 
 	'statut'    => 'required', 
 	'commentaire'    => 'required', 
	]);
	$unmesure = new Mesure;
	$unmesure->create([
 	'indicateur_id'    => $this->indicateur_id, 
 	'periode_id'    => $this->periode_id, 
 	'cible'    => $this->cible, 
 	'valeur'    => $this->valeur, 
 	'statut'    => $this->statut, 
 	'commentaire'    => $this->commentaire, 
	]);
	$this->resetMesure();
	 return redirect()->route('monitoring.mesures');
}

public function showMesure($id) {
	 $this->state       = 'show';
 	$this->sid = $id;
	$this->unmesure =  Mesure::find($id);
 	$this->indicateur_id    = $this->unmesure->indicateur_id; 
 	$this->periode_id    = $this->unmesure->periode_id; 
 	$this->cible    = $this->unmesure->cible; 
 	$this->valeur    = $this->unmesure->valeur; 
 	$this->statut    = $this->unmesure->statut; 
 	$this->commentaire    = $this->unmesure->commentaire; 
}

public function editMesure($id) {
	 $this->state       = 'edit';
 	$this->sid = $id;
	$this->unmesure =  Mesure::find($id);
if($this->unmesure != null) {
 	$this->indicateur_id    = $this->unmesure->indicateur_id; 
 	$this->periode_id    = $this->unmesure->periode_id; 
 	$this->cible    = $this->unmesure->cible; 
 	$this->valeur    = $this->unmesure->valeur; 
 	$this->statut    = $this->unmesure->statut; 
 	$this->commentaire    = $this->unmesure->commentaire; 
}}

public function updateMesure() {
	$this->validate([
 	'indicateur_id'    => 'required', 
 	'periode_id'    => 'required', 
 	'cible'    => 'required', 
 	'valeur'    => 'required', 
 	'statut'    => 'required', 
 	'commentaire'    => 'required', 
	]);
	if ($this->sid) {
   $unmesure = Mesure::find($this->sid);
	$unmesure->update([
 	'indicateur_id'    => $this->indicateur_id, 
 	'periode_id'    => $this->periode_id, 
 	'cible'    => $this->cible, 
 	'valeur'    => $this->valeur, 
 	'statut'    => $this->statut, 
 	'commentaire'    => $this->commentaire, 
	]);
	$this->resetMesure();
	 return redirect()->route('monitoring.mesures');

}}

public function destroyMesure($id)
{
 if ($id) {
  	   $unmesure = Mesure::find( $id);
   	 $unmesure->delete();
	}


	 return redirect()->route('monitoring.mesures');
}

}
