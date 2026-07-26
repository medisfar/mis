<?php
namespace App\Livewire\Datacollect\Psessions;
use Livewire\Component;
use \App\Traits\PsessionTrait;
use \App\Models\Psession;
use Livewire\WithPagination;
class PsessionListe extends Component {
use PsessionTrait;
use WithPagination;

       protected $paginationTheme = 'bootstrap';protected $listeners = ['unpsessionUpdate' => 'refresh'];
public function refresh(){
    $this->psessions = \App\Models\Psession::orderBy('created_at','desc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\Psession::query();
	if($this->search!==null) 
	$qr=\App\Models\Psession::where('nom',$this->search);
	$this->psessions=$qr->orderBy('created_at','desc')->paginate(20);
	if($this->sid!==null) 
	$this->unpsession=\App\Models\Psession::find($this->sid);
	return view('livewire.datacollect.psessions.psession-liste',
	   ['psessions'=>$this->psessions,'psession'=>$this->unpsession]);
}

public function resetPsession() {
	 $this->nom  = '';
	 $this->projet_id  = '';
	 $this->actif  = '';
}
}