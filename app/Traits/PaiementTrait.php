<?php
namespace App\Traits;
use Livewire\Component;
use \App\Models\Paiement;
Trait PaiementTrait {
  protected $paiements,$unpaiement;
  public  $sid,$state='home',$search;
  public $credit_id,$date_paiement,$montant_paye,$montant_restant;

public function resetPaiement() {
	 $this->credit_id  = '';
	 $this->date_paiement  = '';
	 $this->montant_paye  = '';
	 $this->montant_restant  = '';
}

public function cancelPaiement() {
	 $this->state       = 'home';
}

public function createPaiement() {
	 $this->state       = 'create';
 	$this->sid = null;
	$this->unpaiement = new Paiement;
}

public function storePaiement() {
	$this->validate([
 	'credit_id'    => 'required', 
 	'date_paiement'    => 'required', 
 	'montant_paye'    => 'required', 
 	'montant_restant'    => 'required', 
	]);
	$unpaiement = new Paiement;
	$unpaiement->create([
 	'credit_id'    => $this->credit_id, 
 	'date_paiement'    => $this->date_paiement, 
 	'montant_paye'    => $this->montant_paye, 
 	'montant_restant'    => $this->montant_restant, 
	]);
	$this->resetPaiement();
	 return redirect()->route('microfinance.paiements');
}

public function showPaiement($id) {
	 $this->state       = 'show';
 	$this->sid = $id;
	$this->unpaiement =  Paiement::find($id);
 	$this->credit_id    = $this->unpaiement->credit_id; 
 	$this->date_paiement    = $this->unpaiement->date_paiement; 
 	$this->montant_paye    = $this->unpaiement->montant_paye; 
 	$this->montant_restant    = $this->unpaiement->montant_restant; 
}

public function editPaiement($id) {
	 $this->state       = 'edit';
 	$this->sid = $id;
	$this->unpaiement =  Paiement::find($id);
if($this->unpaiement != null) {
 	$this->credit_id    = $this->unpaiement->credit_id; 
 	$this->date_paiement    = $this->unpaiement->date_paiement; 
 	$this->montant_paye    = $this->unpaiement->montant_paye; 
 	$this->montant_restant    = $this->unpaiement->montant_restant; 
}}

public function updatePaiement() {
	$this->validate([
 	'credit_id'    => 'required', 
 	'date_paiement'    => 'required', 
 	'montant_paye'    => 'required', 
 	'montant_restant'    => 'required', 
	]);
	if ($this->sid) {
   $unpaiement = Paiement::find($this->sid);
	$unpaiement->update([
 	'credit_id'    => $this->credit_id, 
 	'date_paiement'    => $this->date_paiement, 
 	'montant_paye'    => $this->montant_paye, 
 	'montant_restant'    => $this->montant_restant, 
	]);
	$this->resetPaiement();
	 return redirect()->route('microfinance.paiements');

}}

public function destroyPaiement($id)
{
 if ($id) {
  	   $unpaiement = Paiement::find( $id);
   	 $unpaiement->delete();
	}


	 return redirect()->route('microfinance.paiements');
}

}
