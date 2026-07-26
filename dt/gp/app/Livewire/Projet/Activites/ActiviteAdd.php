<?php
namespace App\Livewire\Projet\Activites;
use Livewire\Component;
use \App\Traits\ActiviteTrait;
use \App\Models\Activite;
class ActiviteAdd extends Component {
use ActiviteTrait;
public function render() {
	$qr=\App\Models\Activite::query();
	$this->activites=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unactivite=\App\Models\Activite::find($this->sid);
	$this->createActivite($this->sid);	return view('livewire.projet.activites.activite-add',
	   ['activites'=>$this->activites,'activite'=>$this->unactivite]);
}

public function resetActivite() {
	 $this->nom_activite  = '';
	 $this->composante_id  = '';
	 $this->sous_composante_id  = '';
	 $this->date_debut  = '';
	 $this->date_fin  = '';
	 $this->completed  = '';
}
}