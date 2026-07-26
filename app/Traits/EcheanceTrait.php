<?php
namespace App\Traits;
use Livewire\Component;
use \App\Models\Echeance;
Trait EcheanceTrait {
  protected $echeances,$unecheance;
  public  $sid,$state='home',$search;
  public $membre_id,$montant,$date_paiement;

public function resetEcheance() {
	 $this->membre_id  = '';
	 $this->montant  = '';
	 $this->date_paiement  = '';
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
 	'membre_id'    => 'required', 
 	'montant'    => 'required', 
 	'date_paiement'    => 'required', 
	]);
	$unecheance = new Echeance;
	$unecheance->create([
 	'membre_id'    => $this->membre_id, 
 	'montant'    => $this->montant, 
 	'date_paiement'    => $this->date_paiement, 
	]);
	$this->resetEcheance();
	 return redirect()->route('pret.echeances');
}

public function showEcheance($id) {
	 $this->state       = 'show';
 	$this->sid = $id;
	$this->unecheance =  Echeance::find($id);
 	$this->membre_id    = $this->unecheance->membre_id; 
 	$this->montant    = $this->unecheance->montant; 
 	$this->date_paiement    = $this->unecheance->date_paiement; 
}

public function editEcheance($id) {
	 $this->state       = 'edit';
 	$this->sid = $id;
	$this->unecheance =  Echeance::find($id);
if($this->unecheance != null) {
 	$this->membre_id    = $this->unecheance->membre_id; 
 	$this->montant    = $this->unecheance->montant; 
 	$this->date_paiement    = $this->unecheance->date_paiement; 
}}

public function updateEcheance() {
	$this->validate([
 	'membre_id'    => 'required', 
 	'montant'    => 'required', 
 	'date_paiement'    => 'required', 
	]);
	if ($this->sid) {
   $unecheance = Echeance::find($this->sid);
	$unecheance->update([
 	'membre_id'    => $this->membre_id, 
 	'montant'    => $this->montant, 
 	'date_paiement'    => $this->date_paiement, 
	]);
	$this->resetEcheance();
	 return redirect()->route('pret.echeances');

}}

public function destroyEcheance($id)
{
 if ($id) {
  	   $unecheance = Echeance::find( $id);
   	 $unecheance->delete();
	}


	 return redirect()->route('pret.echeances');
}

}
