<?php
namespace App\Livewire\Projet\Bailleurs;
use Livewire\Component;
use \App\Traits\BailleurTrait;
use \App\Models\Bailleur;
use Livewire\WithPagination;
class BailleurListe extends Component {
use BailleurTrait;
use WithPagination;

       protected $paginationTheme = 'bootstrap';public function render() {
	$qr=\App\Models\Bailleur::query();
	if($this->search!==null) 
	$qr=\App\Models\Bailleur::where('code',$this->search);
	$this->bailleurs=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unbailleur=\App\Models\Bailleur::find($this->sid);
	return view('livewire.projet.bailleurs.bailleur-liste',
	   ['bailleurs'=>$this->bailleurs,'bailleur'=>$this->unbailleur]);
}

public function resetBailleur() {
	 $this->code  = '';
	 $this->nom_bailleur  = '';
}
}