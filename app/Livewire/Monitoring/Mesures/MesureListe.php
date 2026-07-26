<?php
namespace App\Livewire\Monitoring\Mesures;
use Livewire\Component;
use \App\Traits\MesureTrait;
use \App\Models\Mesure;
use Livewire\WithPagination;
class MesureListe extends Component {
use MesureTrait;
use WithPagination;

       protected $paginationTheme = 'bootstrap';protected $listeners = ['unmesureUpdate' => 'refresh'];
public function refresh(){
    $this->mesures = \App\Models\Mesure::orderBy('code','asc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\Mesure::query();
	if($this->search!==null) 
	$qr=\App\Models\Mesure::where('indicateur_id',$this->search);
	$this->mesures=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unmesure=\App\Models\Mesure::find($this->sid);
	return view('livewire.monitoring.mesures.mesure-liste',
	   ['mesures'=>$this->mesures,'mesure'=>$this->unmesure]);
}

public function resetMesure() {
	 $this->indicateur_id  = '';
	 $this->periode_id  = '';
	 $this->cible  = '';
	 $this->valeur  = '';
	 $this->statut  = '';
	 $this->commentaire  = '';
}
}