<?php
namespace App\Livewire\Monitoring\Secteurs;
use Livewire\Component;
use \App\Traits\SecteurTrait;
use \App\Models\Secteur;
class SecteurEdit extends Component {
use SecteurTrait;
public function mount($id) {
	$this->sid=$id;
	$this->editSecteur($this->sid);}
public function render() {
	$qr=\App\Models\Secteur::query();
	$this->secteurs=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unsecteur=\App\Models\Secteur::find($this->sid);
	return view('livewire.monitoring.secteurs.secteur-edit',
	   ['secteurs'=>$this->secteurs,'secteur'=>$this->unsecteur]);
}

public function resetSecteur() {
	 $this->nom_secteur  = '';
	 $this->mission_id  = '';
}
}