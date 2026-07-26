<?php
namespace App\Livewire\Projet\Activites;
use Livewire\Component;
use \App\Traits\ActiviteTrait;
use \App\Models\Activite;
use Livewire\WithPagination;
class ActiviteListe extends Component {
use ActiviteTrait;
use WithPagination;

       protected $paginationTheme = 'bootstrap';public function render() {
	$qr=\App\Models\Activite::query();
	if($this->search!==null) 
	$qr=\App\Models\Activite::where('nom_activite',$this->search);
	$this->activites=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unactivite=\App\Models\Activite::find($this->sid);
	return view('livewire.projet.activites.activite-liste',
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