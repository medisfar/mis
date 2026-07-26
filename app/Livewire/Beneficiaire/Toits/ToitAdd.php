<?php
namespace App\Livewire\Beneficiaire\Toits;
use Livewire\Component;
use \App\Traits\ToitTrait;
use \App\Models\Toit;
class ToitAdd extends Component {
use ToitTrait;
public function render() {
	$qr=\App\Models\Toit::query();
	$this->toits=$qr->paginate(20);
	if($this->sid!==null) 
	$this->untoit=\App\Models\Toit::find($this->sid);
	$this->createToit($this->sid);	return view('livewire.beneficiaire.toits.toit-add',
	   ['toits'=>$this->toits,'toit'=>$this->untoit]);
}

public function resetToit() {
	 $this->adresse  = '';
}
}