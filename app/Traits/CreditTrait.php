<?php
namespace App\Traits;
use Livewire\Component;
use \App\Models\Credit;
Trait CreditTrait {
  protected $credits,$uncredit;
  public  $sid,$state='home',$search;
  public $membre_id,$date_octroi,$date_premiere_echeance,$montant_echeance,$nbre_echeance,$termine;

public function resetCredit() {
	 $this->membre_id  = '';
	 $this->date_octroi  = '';
	 $this->date_premiere_echeance  = '';
	 $this->montant_echeance  = '';
	 $this->nbre_echeance  = '';
	 $this->termine  = '';
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
	'membre_id'    => 'required|exists:membres,id',
 	'date_octroi'    => 'required', 
 	'date_premiere_echeance'    => 'required', 
 	'montant_echeance'    => 'required', 
 	'nbre_echeance'    => 'required', 
 	'termine'    => 'required', 
	]);
	$uncredit = new Credit;
	$uncredit->create([
	'membre_id'    => $this->membre_id,
 	'date_octroi'    => $this->date_octroi, 
 	'date_premiere_echeance'    => $this->date_premiere_echeance, 
 	'montant_echeance'    => $this->montant_echeance, 
 	'nbre_echeance'    => $this->nbre_echeance, 
 	'termine'    => $this->termine, 
	]);
	$this->resetCredit();
	 return redirect()->route('microfinance.credits');
}

public function showCredit($id) {
	 $this->state       = 'show';
 	$this->sid = $id;
	$this->uncredit =  Credit::find($id);
	$this->membre_id    = $this->uncredit->membre_id;
 	$this->date_octroi    = $this->uncredit->date_octroi; 
 	$this->date_premiere_echeance    = $this->uncredit->date_premiere_echeance; 
 	$this->montant_echeance    = $this->uncredit->montant_echeance; 
 	$this->nbre_echeance    = $this->uncredit->nbre_echeance; 
 	$this->termine    = $this->uncredit->termine; 
}

public function editCredit($id) {
	 $this->state       = 'edit';
 	$this->sid = $id;
	$this->uncredit =  Credit::find($id);
if($this->uncredit != null) {
	$this->membre_id    = $this->uncredit->membre_id;
 	$this->date_octroi    = $this->uncredit->date_octroi; 
 	$this->date_premiere_echeance    = $this->uncredit->date_premiere_echeance; 
 	$this->montant_echeance    = $this->uncredit->montant_echeance; 
 	$this->nbre_echeance    = $this->uncredit->nbre_echeance; 
 	$this->termine    = $this->uncredit->termine; 
}}

public function updateCredit() {
	$this->validate([
	'membre_id'    => 'required|exists:membres,id',
 	'date_octroi'    => 'required', 
 	'date_premiere_echeance'    => 'required', 
 	'montant_echeance'    => 'required', 
 	'nbre_echeance'    => 'required', 
 	'termine'    => 'required', 
	]);
	if ($this->sid) {
   $uncredit = Credit::find($this->sid);
	$uncredit->update([
	'membre_id'    => $this->membre_id,
 	'date_octroi'    => $this->date_octroi, 
 	'date_premiere_echeance'    => $this->date_premiere_echeance, 
 	'montant_echeance'    => $this->montant_echeance, 
 	'nbre_echeance'    => $this->nbre_echeance, 
 	'termine'    => $this->termine, 
	]);
	$this->resetCredit();
	 return redirect()->route('microfinance.credits');

}}

public function destroyCredit($id)
{
 if ($id) {
  	   $uncredit = Credit::find( $id);
   	 $uncredit->delete();
	}


	 return redirect()->route('microfinance.credits');
}

}
