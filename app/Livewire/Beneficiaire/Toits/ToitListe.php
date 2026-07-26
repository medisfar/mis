<?php
namespace App\Livewire\Beneficiaire\Toits;
use Livewire\Component;
use \App\Traits\ToitTrait;
use \App\Models\Toit;
use Livewire\WithPagination;
class ToitListe extends Component {
use ToitTrait;
use WithPagination;

       protected $paginationTheme = 'bootstrap';public function render() {
	$qr=\App\Models\Toit::query();
	if($this->search!==null) 
	$qr=\App\Models\Toit::where('adresse',$this->search);
	$this->toits=$qr->paginate(20);
	if($this->sid!==null) 
	$this->untoit=\App\Models\Toit::find($this->sid);
	return view('livewire.beneficiaire.toits.toit-liste',
	   ['toits'=>$this->toits,'toit'=>$this->untoit]);
}

public function resetToit() {
	 $this->adresse  = '';
}
}