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
	$qr->where('projet_id',session()->get('pid'));
	if($this->activite_id)
		$this->taches=$qr->where('activite_id',$this->activite_id);
	if($this->site_id)
		$this->taches=$qr->where('site_id',$this->site_id);
	
	if($this->sid!==null) 
	$this->untache=\App\Models\Tache::find($this->sid);
       $this->taches=$qr->paginate(20);

       //dd($qr->paginate(20));
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