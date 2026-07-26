<?php
namespace App\Livewire\Datacollect\Psessions;
use Livewire\Component;
use \App\Traits\PsessionTrait;
use \App\Models\Psession;
class PsessionShow extends Component {
use PsessionTrait;
public function mount($id) {
	$this->sid=$id;
	$this->editPsession($this->sid);}
protected $listeners = ['unpsessionUpdate' => 'refresh'];
public function refresh(){
    $this->psessions = \App\Models\Psession::orderBy('code','asc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\Psession::query();
	$this->psessions=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unpsession=\App\Models\Psession::find($this->sid);
	return view('livewire.datacollect.psessions.psession-show',
	   ['psessions'=>$this->psessions,'psession'=>$this->unpsession]);
}

public function resetPsession() {
	 $this->nom  = '';
	 $this->projet_id  = '';
	 $this->actif  = '';
}
}