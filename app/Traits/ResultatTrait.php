<?php
namespace App\Traits;
use Livewire\Component;
use \App\Models\Resultat;
Trait ResultatTrait {
  protected $resultats,$unresultat;
  public  $sid,$state='home',$search,$mission_id;
  public $description;

public function resetResultat() {
	 $this->description  = '';
	  $this->secteur_id  = '';
}

public function cancelResultat() {
	 $this->state       = 'home';
}

public function createResultat() {
	 $this->state       = 'create';
 	$this->sid = null;
	$this->unresultat = new Resultat;
}

public function storeResultat() {
	$this->validate([
 	'description'    => 'required', 
 
 		'mission_id'=>'required',
	]);
	$unresultat = new Resultat;
	$unresultat->create([
 	'description'    => $this->description, 
 		
 			'mission_id'=>$this->mission_id, 
	]);
	$this->resetResultat();
	 $this->dispatch('resultatUpdate');
   $this->dispatch('hide-modal');
}

public function showResultat($id) {
	 $this->state       = 'show';
 	$this->sid = $id;
	$this->unresultat =  Resultat::find($id);
 	$this->description    = $this->unresultat->description; 
 
 	$this->mission_id    = $this->unresultat->mission_id; 
}

public function editResultat($id) {
	 $this->state       = 'edit';
 	$this->sid = $id;
	$this->unresultat =  Resultat::find($id);
if($this->unresultat != null) {
 	$this->description    = $this->unresultat->description; 
 	
 			$this->mission_id    = $this->unresultat->mission_id; 

}}

public function updateResultat() {
	$this->validate([
 	'description'    => 'required', 
 		'mission_id'=>'required',
	]);
	if ($this->sid) {
   $unresultat = Resultat::find($this->sid);
	$unresultat->update([
 	'description'    => $this->description, 
 	
 			'mission_id'=>$this->mission_id, 
	]);
	$this->resetResultat();
	$this->dispatch('resultatUpdate');
   $this->dispatch('hide-modal');
}}

public function destroyResultat($id)
{
 if ($id) {
  	   $unresultat = Resultat::find( $id);
   	 $unresultat->delete();
	}


	 return redirect()->route('monitoring.resultats');
}

}
