<?php
namespace App\Traits;
use Livewire\Component;
use \App\Models\Activite;
Trait ActiviteTrait {
  protected $activites,$unactivite;
  public  $sid,$state='home',$search;
  public $pid,$cid,$activite,$composante_id,$sous_composante_id,$date_debut,$date_fin,$budget,$localite_id,$statut;
  public $rid,$pfid,$spfid;

public function resetActivite() {
	$this->activite  = '';
	 
	 $this->composante_id  = '';
	 $this->sous_composante_id  = '';
	 $this->date_debut  = '';
	 $this->date_fin  = '';
	 $this->budget  = '';
	   $this->statut  = '';
	 
	 //$this->completed  = '';
	 $this->localite_id  = '';
}

public function cancelActivite() {
	 $this->state       = 'home';
}

public function createActivite() {
	 $this->state       = 'create';
 	$this->sid = null;
	$this->unactivite = new Activite;
}

public function storeActivite() {
	$this->validate([
 	'activite'    => 'required', 
 	
 	 'composante_id'=> 'required',
 	'date_debut'    => 'required', 
 	'date_fin'    => 'required', 
 	'budget'    => 'required', 
 	'statut'    => 'required', 
 	
 //	'completed'    => 'required', 
 //	'localite_id'    => 'required', 
	]);
	$unactivite = new Activite;
	$unactivite->create([
 	'activite'    => $this->activite, 
 	'composante_id'    => $this->composante_id, 
 	'sous_composante_id'    => $this->sous_composante_id, 
 	'date_debut'    => $this->date_debut, 
 	'date_fin'    => $this->date_fin, 
 	'budget'    => $this->budget, 
 	'statut'    => $this->statut, 


 //'completed'    => $this->completed, 
 'localite_id'    => 0, 
 	 
	]);
	$this->resetActivite();
	 	$this->dispatch('activiteUpdate');

	$this->dispatch('hide-modal');

}

public function showActivite($id) {
	 $this->state       = 'show';
 	$this->sid = $id;
	$this->unactivite =  Activite::find($id);
 	$this->activite    = $this->unactivite->activite; 
 	dd($this->unaxtivite);
 	$this->composante_id    = $this->unactivite->composante_id; 
 	$this->sous_composante_id    = $this->unactivite->sous_composante_id; 
 	$this->date_debut    = $this->unactivite->date_debut; 
 	$this->date_fin    = $this->unactivite->date_fin; 
 	$this->budget    = $this->unactivite->budget; 
 	 	$this->statut    = $this->unactivite->statut; 
 	 	 
 //	$this->completed    = $this->unactivite->completed; 
 	$this->localite_id    = $this->unactivite->localite_id; 
}

public function editActivite($id) {
	 $this->state       = 'edit';
 	$this->sid = $id;
	$this->unactivite =  Activite::find($id);
if($this->unactivite != null) {
 
 	$this->activite    = $this->unactivite->activite; 
 	$this->composante_id    = $this->unactivite->composante_id; 
 	$this->sous_composante_id    = $this->unactivite->sous_composante_id; 
 	$this->date_debut    = $this->unactivite->date_debut; 
 	$this->date_fin    = $this->unactivite->date_fin; 
 	$this->budget    = $this->unactivite->budget; 
 	$this->statut    = $this->unactivite->statut; 

 	//$this->completed    = $this->unactivite->completed; 
 		$this->localite_id    = 0;
 		//dd($this->unactivite);
}}

public function updateActivite() {
    
	$this->validate([
 	'activite'    => 'required', 
 	
 	'date_debut'    => 'required', 
 	'date_fin'    => 'required', 
 	'composante_id'=> 'required',
 	'budget'    => 'required',
 	'statut'    => 'required', 
 
 //	'completed'    => 'required', 
 	'localite_id'    => 'required', 
	]);
	if ($this->sid) {
   $unactivite = Activite::find($this->sid);
   $dt=[
 	'activite'    => $this->activite, 
 	'composante_id'    => $this->composante_id, 
 	'sous_composante_id'    => $this->sous_composante_id, 
 	'date_debut'    => $this->date_debut, 
 	'date_fin'    => $this->date_fin, 
 	'statut'    => $this->statut, 
 	'budget'    => $this->budget, 
 
 //	'completed'    => $this->completed, 
 	'localite_id'    => $this->localite_id, 
	];
	//dd($dt);
	$unactivite->update($dt);
 	 
	$this->resetActivite();
	$this->dispatch('activiteUpdate');

	$this->dispatch('hide-modal');
	

}}

public function destroyActivite($id)
{
 if ($id) {
  	   $unactivite = Activite::find( $id);
   	 $unactivite->delete();
   	 $this->dispatch('activiteUpdate');

	$this->dispatch('hide-modal');
	}

}

}
