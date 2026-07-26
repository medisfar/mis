<?php
namespace App\Livewire\Monitoring\Lessessions;
use Livewire\Component;
use \App\Traits\LessessionTrait;
use \App\Models\Lessession;
class LessessionAdd extends Component {
use LessessionTrait;
protected $listeners = ['unlessessionUpdate' => 'refresh'];
public function refresh(){
    $this->lessessions = \App\Models\Lessession::orderBy('code','asc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\Lessession::query();
	$this->lessessions=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unlessession=\App\Models\Lessession::find($this->sid);
	$this->createLessession($this->sid);	return view('livewire.monitoring.lessessions.lessession-add',
	   ['lessessions'=>$this->lessessions,'lessession'=>$this->unlessession]);
}

public function resetLessession() {
	 $this->site_id  = '';
	 $this->date_session  = '';
	 $this->groupement_id  = '';
}
}