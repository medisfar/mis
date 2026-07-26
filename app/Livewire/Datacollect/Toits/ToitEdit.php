<?php
namespace App\Livewire\Datacollect\Toits;
use Livewire\Component;
use \App\Traits\ToitTrait;
use \App\Models\Toit;
class ToitEdit extends Component {
use ToitTrait;
public function mount($id) {
	$this->sid=$id;
	$this->editToit($this->sid);}
protected $listeners = ['untoitUpdate' => 'refresh'];
public function refresh(){
    $this->toits = \App\Models\Toit::orderBy('code','asc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\Toit::query();
	$this->toits=$qr->paginate(20);
	if($this->sid!==null) 
	$this->untoit=\App\Models\Toit::find($this->sid);
	return view('livewire.datacollect.toits.toit-edit',
	   ['toits'=>$this->toits,'toit'=>$this->untoit]);
}

public function resetToit() {
	 $this->zone_id  = '';
	 $this->adresse  = '';
}
}