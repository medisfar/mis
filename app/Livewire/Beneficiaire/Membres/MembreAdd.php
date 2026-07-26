<?php
namespace App\Livewire\Beneficiaire\Membres;
use Livewire\Component;
use \App\Traits\MembreTrait;
use \App\Models\Membre;
class MembreAdd extends Component {
use MembreTrait;
public function render() {
	$idm=request()->get('idm',0);
	if($idm>0) $this->menage_id=$idm;
return view('livewire.beneficiaire.membres.membre-add',
	   ['membre'=>$this->unmembre,'idm'=>$idm]);
}

public function resetMembre() {
	 $this->menage_id  = '';
	 $this->genre  = '';
	 $this->nom  = '';
	 $this->date_naissance  = '';
	 $this->lien_parente  = '';
	 $this->enceinte  = '';
}
}