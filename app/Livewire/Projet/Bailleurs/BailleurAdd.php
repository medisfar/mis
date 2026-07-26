<?php
namespace App\Livewire\Projet\Bailleurs;
use Livewire\Component;
use \App\Traits\BailleurTrait;
use \App\Models\Bailleur;
class BailleurAdd extends Component {
use BailleurTrait;
public function render() {
	$qr=\App\Models\Bailleur::query();
	$this->bailleurs=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unbailleur=\App\Models\Bailleur::find($this->sid);
	$this->createBailleur($this->sid);	return view('livewire.projet.bailleurs.bailleur-add',
	   ['bailleurs'=>$this->bailleurs,'bailleur'=>$this->unbailleur]);
}

public function resetBailleur() {
	 $this->code  = '';
	 $this->nom_bailleur  = '';
}
}