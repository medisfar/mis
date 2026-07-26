<?php
namespace App\Livewire\Monitoring\Lessessions;
use Livewire\Component;
use \App\Traits\LessessionTrait;
use \App\Models\Lessession;
class LessessionEdit extends Component {
use LessessionTrait;
public function mount($id) {
	$this->sid=$id;
	$this->editLessession($this->sid);}
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
	return view('livewire.monitoring.lessessions.lessession-edit',
	   ['lessessions'=>$this->lessessions,'lessession'=>$this->unlessession]);
}

public function resetLessession() {
	 $this->site_id  = '';
	 $this->date_session  = '';
	 $this->groupement_id  = '';
}
}