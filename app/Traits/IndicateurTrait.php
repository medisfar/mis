<?php
namespace App\Traits;
use Livewire\Component;
use \App\Models\Indicateur;
Trait IndicateurTrait {
  protected $indicateurs,$unindicateur;
  public  $sid,$state='home',$search,$cid;
  public $activite_id,$nom,$frequence,$unite_mesure,$baseline,$cible_finale,$valeur_actuelle,$niveau,$source;

public function resetIndicateur() {
	 $this->activite_id  = '';
	 $this->nom  = '';
	 $this->frequence  = '';
	 $this->unite_mesure  = '';
	 $this->baseline  = '';
	 $this->cible_finale  = '';
	 $this->valeur_actuelle  = '';
	 $this->niveau  = '';
	 $this->source  = '';
}

public function cancelIndicateur() {
	 $this->state       = 'home';
}

public function createIndicateur() {
	 $this->state       = 'create';
 	$this->sid = null;
	$this->unindicateur = new Indicateur;
}

public function storeIndicateur() {
	$this->validate([
 	'activite_id'    => 'required', 
 	'nom'    => 'required', 
 	'frequence'    => 'required', 
 	'unite_mesure'    => 'required', 
 	'baseline'    => 'required', 
 	'cible_finale'    => 'required', 
 	'valeur_actuelle'    => 'required', 
 	'niveau'    => 'required', 
 	'source'    => 'required', 
	]);
	$unindicateur = new Indicateur;
	$unindicateur->create([
 	'activite_id'    => $this->activite_id, 
 	'nom'    => $this->nom, 
 	'frequence'    => $this->frequence, 
 	'unite_mesure'    => $this->unite_mesure, 
 	'baseline'    => $this->baseline, 
 	'cible_finale'    => $this->cible_finale, 
 	'valeur_actuelle'    => $this->valeur_actuelle, 
 	'niveau'    => $this->niveau, 
 	'source'    => $this->source, 
	]);
	$this->resetIndicateur();
	 return redirect()->route('projet.indicateurs');
}

public function showIndicateur($id) {
	 $this->state       = 'show';
 	$this->sid = $id;
	$this->unindicateur =  Indicateur::find($id);
 	$this->activite_id    = $this->unindicateur->activite_id; 
 	$this->nom    = $this->unindicateur->nom; 
 	$this->frequence    = $this->unindicateur->frequence; 
 	$this->unite_mesure    = $this->unindicateur->unite_mesure; 
 	$this->baseline    = $this->unindicateur->baseline; 
 	$this->cible_finale    = $this->unindicateur->cible_finale; 
 	$this->valeur_actuelle    = $this->unindicateur->valeur_actuelle; 
 	$this->niveau    = $this->unindicateur->niveau; 
 	$this->source    = $this->unindicateur->source; 
}

public function editIndicateur($id) {
	 $this->state       = 'edit';
 	$this->sid = $id;
	$this->unindicateur =  Indicateur::find($id);
if($this->unindicateur != null) {
 	$this->activite_id    = $this->unindicateur->activite_id; 
 	$this->nom    = $this->unindicateur->nom; 
 	$this->frequence    = $this->unindicateur->frequence; 
 	$this->unite_mesure    = $this->unindicateur->unite_mesure; 
 	$this->baseline    = $this->unindicateur->baseline; 
 	$this->cible_finale    = $this->unindicateur->cible_finale; 
 	$this->valeur_actuelle    = $this->unindicateur->valeur_actuelle; 
 	$this->niveau    = $this->unindicateur->niveau; 
 	$this->source    = $this->unindicateur->source; 
}}

public function updateIndicateur() {
	$this->validate([
 	'activite_id'    => 'required', 
 	'nom'    => 'required', 
 	'frequence'    => 'required', 
 	'unite_mesure'    => 'required', 
 	'baseline'    => 'required', 
 	'cible_finale'    => 'required', 
 	'valeur_actuelle'    => 'required', 
 	'niveau'    => 'required', 
 	'source'    => 'required', 
	]);
	if ($this->sid) {
   $unindicateur = Indicateur::find($this->sid);
	$unindicateur->update([
 	'activite_id'    => $this->activite_id, 
 	'nom'    => $this->nom, 
 	'frequence'    => $this->frequence, 
 	'unite_mesure'    => $this->unite_mesure, 
 	'baseline'    => $this->baseline, 
 	'cible_finale'    => $this->cible_finale, 
 	'valeur_actuelle'    => $this->valeur_actuelle, 
 	'niveau'    => $this->niveau, 
 	'source'    => $this->source, 
	]);
	$this->resetIndicateur();
	 return redirect()->route('projet.indicateurs');

}}

public function destroyIndicateur($id)
{
 if ($id) {
  	   $unindicateur = Indicateur::find( $id);
   	 $unindicateur->delete();
	}


	 return redirect()->route('projet.indicateurs');
}

}
