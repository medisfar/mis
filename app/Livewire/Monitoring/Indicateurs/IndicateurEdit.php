<?php
namespace App\Livewire\Monitoring\Indicateurs;
use Livewire\Component;
use \App\Traits\IndicateurTrait;
use \App\Models\Indicateur;
class IndicateurEdit extends Component {
use IndicateurTrait;
public $cid;
public function mount($id) {
	$this->sid=$id;
	$this->editIndicateur($this->sid);}
protected $listeners = ['unindicateurUpdate' => 'refresh'];
public function refresh(){
    $this->indicateurs = \App\Models\Indicateur::orderBy('code','asc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\Indicateur::query();
	$this->indicateurs=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unindicateur=\App\Models\Indicateur::find($this->sid);
	return view('livewire.monitoring.indicateurs.indicateur-edit',
	   ['indicateurs'=>$this->indicateurs,'indicateur'=>$this->unindicateur]);
}

public function resetIndicateur() {
	 $this->activite_id  = '';
	 $this->nom  = '';
	 $this->description  = '';
	 $this->frequence  = '';
	 $this->formule  = '';
	 $this->unite_mesure  = '';
	 $this->type_cible  = '';
	 $this->baseline  = '';
	 $this->baseline_date  = '';
	 $this->est_actif  = '';
}
}