<?php
namespace App\Livewire\Projet\Bailleurs;
use Livewire\Component;
use \App\Traits\BailleurTrait;
use \App\Models\Bailleur;
class BailleurEdit extends Component {
use BailleurTrait;
public function mount($id) {
	$this->sid=$id;
	$this->editBailleur($this->sid);}
public function render() {
	$qr=\App\Models\Bailleur::query();
	$this->bailleurs=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unbailleur=\App\Models\Bailleur::find($this->sid);
	return view('livewire.projet.bailleurs.bailleur-edit',
	   ['bailleurs'=>$this->bailleurs,'bailleur'=>$this->unbailleur]);
}

public function resetBailleur() {
	 $this->code  = '';
	 $this->nom_bailleur  = '';
}
}