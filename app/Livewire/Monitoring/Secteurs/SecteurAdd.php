<?php
namespace App\Livewire\Monitoring\Secteurs;
use Livewire\Component;
use \App\Traits\SecteurTrait;
use \App\Models\Secteur;
class SecteurAdd extends Component {
use SecteurTrait;
public function render() {
	$qr=\App\Models\Secteur::query();
	$this->secteurs=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unsecteur=\App\Models\Secteur::find($this->sid);
	$this->createSecteur($this->sid);	return view('livewire.monitoring.secteurs.secteur-add',
	   ['secteurs'=>$this->secteurs,'secteur'=>$this->unsecteur]);
}

public function resetSecteur() {
	 $this->nom_secteur  = '';
	 $this->mission_id  = '';
}
}