<?php
namespace App\Livewire\Monitoring\Periodes;
use Livewire\Component;
use \App\Traits\PeriodeTrait;
use \App\Models\Periode;
class PeriodeAdd extends Component {
use PeriodeTrait;
protected $listeners = ['unperiodeUpdate' => 'refresh'];
public function refresh(){
    $this->periodes = \App\Models\Periode::orderBy('code','asc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\Periode::query();
	$this->periodes=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unperiode=\App\Models\Periode::find($this->sid);
	$this->createPeriode($this->sid);	return view('livewire.monitoring.periodes.periode-add',
	   ['periodes'=>$this->periodes,'periode'=>$this->unperiode]);
}

public function resetPeriode() {
	 $this->activite_id  = '';
	 $this->indicateur_id  = '';
	 $this->date_debut  = '';
	 $this->date_fin  = '';
	 $this->cible  = '';
}
}