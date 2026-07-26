<?php
namespace App\Livewire\Monitoring\Mesures;
use Livewire\Component;
use \App\Traits\MesureTrait;
use \App\Models\Mesure;
class MesureAdd extends Component {
use MesureTrait;
protected $listeners = ['unmesureUpdate' => 'refresh'];
public function refresh(){
    $this->mesures = \App\Models\Mesure::orderBy('code','asc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\Mesure::query();
	$this->mesures=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unmesure=\App\Models\Mesure::find($this->sid);
	$this->createMesure($this->sid);	return view('livewire.monitoring.mesures.mesure-add',
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