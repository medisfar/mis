<?php
namespace App\Livewire\Projet\Produits;
use Livewire\Component;
use \App\Traits\ProduitTrait;
use \App\Models\Produit;
class ProduitAdd extends Component {
use ProduitTrait;
protected $listeners = ['unproduitUpdate' => 'refresh'];
public function refresh(){
    $this->produits = \App\Models\Produit::orderBy('code','asc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\Produit::query();
	$this->produits=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unproduit=\App\Models\Produit::find($this->sid);
	$this->createProduit($this->sid);	return view('livewire.projet.produits.produit-add',
	   ['produits'=>$this->produits,'produit'=>$this->unproduit]);
}

public function resetProduit() {
	 $this->resultat_id  = '';
	 $this->description  = '';
}
}