<?php
namespace App\Traits;
use Livewire\Component;
use \App\Models\Credit;
Trait CreditTrait {
  protected $credits,$uncredit;
  public  $sid,$state='home',$search;
  public $membre_id,$date_credit,$montant,$nbre_echeance;

public function resetCredit() {
	 $this->membre_id  = '';
	 $this->date_credit  = '';
	 $this->montant  = '';
	 $this->nbre_echeance  = '';
}

public function cancelCredit() {
	 $this->state       = 'home';
}

public function createCredit() {
	 $this->state       = 'create';
 	$this->sid = null;
	$this->uncredit = new Credit;
}

public function storeCredit() {
	$this->validate([
 	'membre_id'    => 'required', 
 	'date_credit'    => 'required', 
 	'montant'    => 'required', 
 	'nbre_echeance'    => 'required', 
	]);
	$uncredit = new Credit;
	$uncredit->create([
 	'membre_id'    => $this->membre_id, 
 	'date_credit'    => $this->date_credit, 
 	'montant'    => $this->montant, 
 	'nbre_echeance'    => $this->nbre_echeance, 
	]);
	$this->resetCredit();
	 return redirect()->route('pret.credits');
}

public function showCredit($id) {
	 $this->state       = 'show';
 	$this->sid = $id;
	$this->uncredit =  Credit::find($id);
 	$this->membre_id    = $this->uncredit->membre_id; 
 	$this->date_credit    = $this->uncredit->date_credit; 
 	$this->montant    = $this->uncredit->montant; 
 	$this->nbre_echeance    = $this->uncredit->nbre_echeance; 
}

public function editCredit($id) {
	 $this->state       = 'edit';
 	$this->sid = $id;
	$this->uncredit =  Credit::find($id);
if($this->uncredit != null) {
 	$this->membre_id    = $this->uncredit->membre_id; 
 	$this->date_credit    = $this->uncredit->date_credit; 
 	$this->montant    = $this->uncredit->montant; 
 	$this->nbre_echeance    = $this->uncredit->nbre_echeance; 
}}

public function updateCredit() {
	$this->validate([
 	'membre_id'    => 'required', 
 	'date_credit'    => 'required', 
 	'montant'    => 'required', 
 	'nbre_echeance'    => 'required', 
	]);
	if ($this->sid) {
   $uncredit = Credit::find($this->sid);
	$uncredit->update([
 	'membre_id'    => $this->membre_id, 
 	'date_credit'    => $this->date_credit, 
 	'montant'    => $this->montant, 
 	'nbre_echeance'    => $this->nbre_echeance, 
	]);
	$this->resetCredit();
	 return redirect()->route('pret.credits');

}}

public function destroyCredit($id)
{
 if ($id) {
  	   $uncredit = Credit::find( $id);
   	 $uncredit->delete();
	}


	 return redirect()->route('pret.credits');
}

}
