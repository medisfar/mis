<?php
namespace App\Livewire\Datacollect\Lessessions;
use Livewire\Component;
use \App\Traits\LessessionTrait;
use \App\Models\Lessession;
class LessessionEdit extends Component {
use LessessionTrait;
public function mount($id) {
	$this->sid=$id;
	$this->editLessession($this->sid);}
protected $listeners = ['lessessionUpdate' => 'refresh'];
public function refresh(){
    //$this->lessessions = \App\Models\Lessession::orderBy('created_at','desc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\Lessession::query();
	$this->lessessions=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unlessession=\App\Models\Lessession::find($this->sid);
	return view('livewire.datacollect.lessessions.lessession-edit',
	   ['lessessions'=>$this->lessessions,'lessession'=>$this->unlessession]);
}

public function resetLessession() {
	 $this->nom  = '';
	 $this->site_id  = '';
	 $this->date_session  = '';
	 $this->groupement_id  = '';
}
}