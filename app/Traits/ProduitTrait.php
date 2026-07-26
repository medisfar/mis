<?php
namespace App\Traits;
use Livewire\Component;
use \App\Models\Produit;
Trait ProduitTrait {
  protected $produits,$unproduit;
  public  $sid,$state='home',$search;
  public $description;

public function resetProduit() {
	 $this->description  = '';
}

public function cancelProduit() {
	 $this->state       = 'home';
}

public function createProduit() {
	 $this->state       = 'create';
 	$this->sid = null;
	$this->unproduit = new Produit;
}

public function storeProduit() {
	$this->validate([
 	'description'    => 'required', 
	]);
	$unproduit = new Produit;
	$unproduit->create([
 	'description'    => $this->description, 
	]);
	$this->resetProduit();
	 return redirect()->route('monitoring.produits');
}

public function showProduit($id) {
	 $this->state       = 'show';
 	$this->sid = $id;
	$this->unproduit =  Produit::find($id);
 	$this->description    = $this->unproduit->description; 
}

public function editProduit($id) {
	 $this->state       = 'edit';
 	$this->sid = $id;
	$this->unproduit =  Produit::find($id);
if($this->unproduit != null) {
 	$this->description    = $this->unproduit->description; 
}}

public function updateProduit() {
	$this->validate([
 	'description'    => 'required', 
	]);
	if ($this->sid) {
   $unproduit = Produit::find($this->sid);
	$unproduit->update([
 	'description'    => $this->description, 
	]);
	$this->resetProduit();
	 return redirect()->route('monitoring.produits');

}}

public function destroyProduit($id)
{
 if ($id) {
  	   $unproduit = Produit::find( $id);
   	 $unproduit->delete();
	}


	 return redirect()->route('monitoring.produits');
}

}
