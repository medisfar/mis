<?php
namespace App\Livewire\Projet\Produits;
use Livewire\Component;
use \App\Traits\ProduitTrait;
use \App\Models\Produit;
class ProduitShow extends Component {
use ProduitTrait;
public $cpid,$activite_id;
public function mount($id) {
	$this->sid=$id;
	$this->editProduit($this->sid);}
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
	return view('livewire.projet.produits.produit-show',
	   ['produits'=>$this->produits,'produit'=>$this->unproduit]);
}

public function resetProduit() {
	 $this->resultat_id  = '';
	 $this->description  = '';
}

public function add(){
   // dd("insert into activite_produit(produit_id,activite_id) values($this->sid,$this->activite_id)");
    \DB::insert("insert into activite_produit(produit_id,activite_id) values($this->sid,$this->activite_id)");
   // dd("insert into produit_resultat(produit_id,resultat_id) values($this->ppid,$this->sid)");
}

public function del(){
   // dd("insert into activite_produit(produit_id,activite_id) values($this->sid,$this->activite_id)");
    \DB::delete("delete from activite_produit where activite_id=$this->activite_id");
   // dd("insert into produit_activite(produit_id,resultat_id) values($this->ppid,$this->sid)");
}
}