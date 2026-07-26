<?php
namespace App\Livewire\Projet\Taches;
use Livewire\Component;
use \App\Traits\TacheTrait;
use \App\Models\Tache;
use Livewire\WithPagination;
class TacheListe extends Component {
use TacheTrait;
use WithPagination;

       protected $paginationTheme = 'bootstrap';public function render() {
	$qr=\App\Models\Tache::query();
	if($this->search!==null) 
	$qr=\App\Models\Tache::where('tache',$this->search);
	$this->taches=$qr->paginate(20);
	if($this->sid!==null) 
	$this->untache=\App\Models\Tache::find($this->sid);
	return view('livewire.projet.taches.tache-liste',
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