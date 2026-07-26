<?php
namespace App\Livewire\Monitoring\Lessessions;
use Livewire\Component;
use \App\Traits\LessessesionTrait;
use \App\Models\Lessessesion;
class LessessesionAdd extends Component {
use LessessesionTrait;
protected $listeners = ['unlessessesionUpdate' => 'refresh'];
public function refresh(){
    $this->lessessions = \App\Models\Lessessesion::orderBy('code','asc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\Lessessesion::query();
	$this->lessessions=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unlessessesion=\App\Models\Lessessesion::find($this->sid);
	$this->createLessessesion($this->sid);	return view('livewire.monitoring.lessessions.lessessesion-add',
	   ['lessessions'=>$this->lessessions,'lessessesion'=>$this->unlessessesion]);
}

public function resetLessessesion() {
	 $this->site_id  = '';
	 $this->date_session  = '';
	 $this->groupement_id  = '';
}
}