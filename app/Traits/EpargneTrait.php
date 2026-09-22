<?php
namespace App\Traits;
use Livewire\Component;
use \App\Models\Epargne;
Trait EpargneTrait {
  protected $epargnes,$unepargne;
  public  $sid,$state='home',$search;
  public $membre_id,$date_operation,$type,$montant;

public function resetEpargne() {
	 $this->membre_id  = '';
	 $this->date_operation  = '';
	 $this->type  = '';
	 $this->montant  = '';
}

public function cancelEpargne() {
	 $this->state       = 'home';
}

public function createEpargne() {
	 $this->state       = 'create';
 	$this->sid = null;
	$this->unepargne = new Epargne;
}

public function storeEpargne() {
	$this->validate([
 	'membre_id'    => 'required', 
 	'date_operation'    => 'required', 
 	'type'    => 'required', 
 	'montant'    => 'required', 
	]);
	$unepargne = new Epargne;
	$unepargne->create([
 	'membre_id'    => $this->membre_id, 
 	'date_operation'    => $this->date_operation, 
 	'type'    => $this->type, 
 	'montant'    => $this->montant, 
	]);
	$this->resetEpargne();
	 return redirect()->route('microfinance.epargnes');
}

public function showEpargne($id) {
	 $this->state       = 'show';
 	$this->sid = $id;
	$this->unepargne =  Epargne::find($id);
 	$this->membre_id    = $this->unepargne->membre_id; 
 	$this->date_operation    = $this->unepargne->date_operation; 
 	$this->type    = $this->unepargne->type; 
 	$this->montant    = $this->unepargne->montant; 
}

public function editEpargne($id) {
	 $this->state       = 'edit';
 	$this->sid = $id;
	$this->unepargne =  Epargne::find($id);
if($this->unepargne != null) {
 	$this->membre_id    = $this->unepargne->membre_id; 
 	$this->date_operation    = $this->unepargne->date_operation; 
 	$this->type    = $this->unepargne->type; 
 	$this->montant    = $this->unepargne->montant; 
}}

public function updateEpargne() {
	$this->validate([
 	'membre_id'    => 'required', 
 	'date_operation'    => 'required', 
 	'type'    => 'required', 
 	'montant'    => 'required', 
	]);
	if ($this->sid) {
   $unepargne = Epargne::find($this->sid);
	$unepargne->update([
 	'membre_id'    => $this->membre_id, 
 	'date_operation'    => $this->date_operation, 
 	'type'    => $this->type, 
 	'montant'    => $this->montant, 
	]);
	$this->resetEpargne();
	 return redirect()->route('microfinance.epargnes');

}}

public function destroyEpargne($id)
{
 if ($id) {
  	   $unepargne = Epargne::find( $id);
   	 $unepargne->delete();
	}


	 return redirect()->route('microfinance.epargnes');
}

}
