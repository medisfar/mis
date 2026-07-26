<?php
namespace App\Livewire\Monitoring\Lessessions;
use Livewire\Component;
use \App\Traits\LessessesionTrait;
use \App\Models\Lessessesion;
class LessessesionShow extends Component {
use LessessesionTrait;
public function mount($id) {
	$this->sid=$id;
	$this->editLessessesion($this->sid);}
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
	return view('livewire.monitoring.lessessions.lessessesion-show',
	   ['lessessions'=>$this->lessessions,'lessessesion'=>$this->unlessessesion]);
}

public function resetLessessesion() {
	 $this->site_id  = '';
	 $this->date_session  = '';
	 $this->groupement_id  = '';
}
}