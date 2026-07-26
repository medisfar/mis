<?php
namespace App\Livewire\Projet\Taches;
use Livewire\Component;
use \App\Traits\TacheTrait;
use \App\Models\Tache;
class TacheAdd extends Component {
use TacheTrait;
public function render() {
	$qr=\App\Models\Tache::query();
	$this->taches=$qr->paginate(20);
	if($this->sid!==null) 
	$this->untache=\App\Models\Tache::find($this->sid);
	$this->createTache($this->sid);	return view('livewire.projet.taches.tache-add',
	   ['taches'=>$this->taches,'tache'=>$this->untache]);
}

public function resetTache() {
	 $this->tache  = '';
	 $this->activite_id  = '';
	 $this->date_debut  = '';
	 $this->date_fin  = '';
	 $this->completed  = '';
}
}