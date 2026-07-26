<?php
namespace App\Livewire\Monitoring\Lessessions;
use Livewire\Component;
use \App\Traits\LessessesionTrait;
use \App\Models\Lessessesion;
use Livewire\WithPagination;
class LessessesionListe extends Component {
use LessessesionTrait;
use WithPagination;

       protected $paginationTheme = 'bootstrap';protected $listeners = ['unlessessesionUpdate' => 'refresh'];
public function refresh(){
    $this->lessessions = \App\Models\Lessessesion::orderBy('code','asc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\Lessessesion::query();
	if($this->search!==null) 
	$qr=\App\Models\Lessessesion::where('site_id',$this->search);
	$this->lessessions=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unlessessesion=\App\Models\Lessessesion::find($this->sid);
	return view('livewire.monitoring.lessessions.lessessesion-liste',
	   ['lessessions'=>$this->lessessions,'lessessesion'=>$this->unlessessesion]);
}

public function resetLessessesion() {
	 $this->site_id  = '';
	 $this->date_session  = '';
	 $this->groupement_id  = '';
}
}