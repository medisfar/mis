<?php
namespace App\Traits;
use Livewire\Component;
use \App\Models\Echeance;
Trait EcheanceTrait {
  protected $echeances,$unecheance;
  public  $sid,$state='home',$search;
  public $date_echeance,$montant_paye;

public function resetEcheance() {
	 $this->date_echeance  = '';
	 $this->montant_paye  = '';
}

public function cancelEcheance() {
	 $this->state       = 'home';
}

public function createEcheance() {
	 $this->state       = 'create';
 	$this->sid = null;
	$this->unecheance = new Echeance;
}

public function storeEcheance() {
	$this->validate([
 	'date_echeance'    => 'required', 
 	'montant_paye'    => 'required', 
	]);
	$unecheance = new Echeance;
	$unecheance->create([
 	'date_echeance'    => $this->date_echeance, 
 	'montant_paye'    => $this->montant_paye, 
	]);
	$this->resetEcheance();
	 return redirect()->route('microfinance.echeances');
}

public function showEcheance($id) {
	 $this->state       = 'show';
 	$this->sid = $id;
	$this->unecheance =  Echeance::find($id);
 	$this->date_echeance    = $this->unecheance->date_echeance; 
 	$this->montant_paye    = $this->unecheance->montant_paye; 
}

public function editEcheance($id) {
	 $this->state       = 'edit';
 	$this->sid = $id;
	$this->unecheance =  Echeance::find($id);
if($this->unecheance != null) {
 	$this->date_echeance    = $this->unecheance->date_echeance; 
 	$this->montant_paye    = $this->unecheance->montant_paye; 
}}

public function updateEcheance() {
	$this->validate([
 	'date_echeance'    => 'required', 
 	'montant_paye'    => 'required', 
	]);
	if ($this->sid) {
   $unecheance = Echeance::find($this->sid);
	$unecheance->update([
 	'date_echeance'    => $this->date_echeance, 
 	'montant_paye'    => $this->montant_paye, 
	]);
	$this->resetEcheance();
	 return redirect()->route('microfinance.echeances');

}}

public function destroyEcheance($id)
{
 if ($id) {
  	   $unecheance = Echeance::find( $id);
   	 $unecheance->delete();
	}


	 return redirect()->route('microfinance.echeances');
}

}
