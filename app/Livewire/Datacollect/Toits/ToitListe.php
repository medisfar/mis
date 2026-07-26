<?php
namespace App\Livewire\Datacollect\Toits;
use Livewire\Component;
use \App\Traits\ToitTrait;
use \App\Models\Toit;
use Livewire\WithPagination;
class ToitListe extends Component {
use ToitTrait;
use WithPagination;

       protected $paginationTheme = 'bootstrap';protected $listeners = ['untoitUpdate' => 'refresh'];
public function refresh(){
    $this->toits = \App\Models\Toit::orderBy('code','asc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\Toit::query();
	if($this->search!==null) 
	$qr=\App\Models\Toit::where('zone_id',$this->search);
	$this->toits=$qr->paginate(20);
	if($this->sid!==null) 
	$this->untoit=\App\Models\Toit::find($this->sid);
	return view('livewire.datacollect.toits.toit-liste',
	   ['toits'=>$this->toits,'toit'=>$this->untoit]);
}

public function resetToit() {
	 $this->zone_id  = '';
	 $this->adresse  = '';
}
}