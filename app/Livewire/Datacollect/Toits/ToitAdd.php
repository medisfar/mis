<?php
namespace App\Livewire\Datacollect\Toits;
use Livewire\Component;
use \App\Traits\ToitTrait;
use \App\Models\Toit;
class ToitAdd extends Component {
use ToitTrait;
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
	$this->createToit($this->sid);	return view('livewire.datacollect.toits.toit-add',
	   ['toits'=>$this->toits,'toit'=>$this->untoit]);
}

public function resetToit() {
	 $this->zone_id  = '';
	 $this->adresse  = '';
}
}