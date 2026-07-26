<?php
namespace App\Traits;
use Livewire\Component;
use \App\Models\Odd;
Trait OddTrait {
  protected $odds,$unodd;
  public  $sid,$state='home',$search;
  public $nom;

public function resetOdd() {
	 $this->nom  = '';
}

public function cancelOdd() {
	 $this->state       = 'home';
}

public function createOdd() {
	 $this->state       = 'create';
 	$this->sid = null;
	$this->unodd = new Odd;
}

public function storeOdd() {
	$this->validate([
 	'nom'    => 'required', 
	]);
	$unodd = new Odd;
	$unodd->create([
 	'nom'    => $this->nom, 
	]);
	$this->resetOdd();
	 return redirect()->route('projet.odds');
}

public function showOdd($id) {
	 $this->state       = 'show';
 	$this->sid = $id;
	$this->unodd =  Odd::find($id);
 	$this->nom    = $this->unodd->nom; 
}

public function editOdd($id) {
	 $this->state       = 'edit';
 	$this->sid = $id;
	$this->unodd =  Odd::find($id);
if($this->unodd != null) {
 	$this->nom    = $this->unodd->nom; 
}}

public function updateOdd() {
	$this->validate([
 	'nom'    => 'required', 
	]);
	if ($this->sid) {
   $unodd = Odd::find($this->sid);
	$unodd->update([
 	'nom'    => $this->nom, 
	]);
	$this->resetOdd();
	 return redirect()->route('projet.odds');

}}

public function destroyOdd($id)
{
 if ($id) {
  	   $unodd = Odd::find( $id);
   	 $unodd->delete();
	}


	 return redirect()->route('projet.odds');
}

}
