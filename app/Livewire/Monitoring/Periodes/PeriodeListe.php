<?php
namespace App\Livewire\Monitoring\Periodes;
use Livewire\Component;
use \App\Traits\PeriodeTrait;
use \App\Models\Periode;
use Livewire\WithPagination;
class PeriodeListe extends Component {
use PeriodeTrait;
use WithPagination;

       protected $paginationTheme = 'bootstrap';protected $listeners = ['unperiodeUpdate' => 'refresh'];
public function refresh(){
    $this->periodes = \App\Models\Periode::orderBy('code','asc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\Periode::query();
	if($this->search!==null) 
	$qr=\App\Models\Periode::where('activite_id',$this->search);
	$this->periodes=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unperiode=\App\Models\Periode::find($this->sid);
	return view('livewire.monitoring.periodes.periode-liste',
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