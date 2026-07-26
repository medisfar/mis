<?php
namespace App\Livewire\Projet\Produits;
use Livewire\Component;
use \App\Traits\ProduitTrait;
use \App\Models\Produit;
use Livewire\WithPagination;
class ProduitListe extends Component {
use ProduitTrait;
use WithPagination;

       protected $paginationTheme = 'bootstrap';protected $listeners = ['unproduitUpdate' => 'refresh'];
public function refresh(){
    $this->produits = \App\Models\Produit::orderBy('code','asc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\Produit::query();
	if($this->search!==null) 
	$qr=\App\Models\Produit::where('resultat_id',$this->search);
	$this->produits=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unproduit=\App\Models\Produit::find($this->sid);
	return view('livewire.projet.produits.produit-liste',
	   ['produits'=>$this->produits,'produit'=>$this->unproduit]);
}

public function resetProduit() {
	 $this->resultat_id  = '';
	 $this->description  = '';
}
}