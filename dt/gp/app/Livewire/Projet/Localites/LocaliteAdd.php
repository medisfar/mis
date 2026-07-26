<?php
namespace App\Livewire\Projet\Localites;
use Livewire\Component;
use \App\Traits\LocaliteTrait;
use \App\Models\Localite;
class LocaliteAdd extends Component {
use LocaliteTrait;
public function render() {
	$qr=\App\Models\Localite::query();
	$this->localites=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unlocalite=\App\Models\Localite::find($this->sid);
	$this->createLocalite($this->sid);	return view('livewire.projet.localites.localite-add',
	   ['localites'=>$this->localites,'localite'=>$this->unlocalite]);
}

public function resetLocalite() {
	 $this->nom_localite  = '';
	 $this->ssprefecture_id  = '';
	 $this->l_type  = '';
}
}