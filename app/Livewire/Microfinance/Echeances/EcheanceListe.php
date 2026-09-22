<?php
namespace App\Livewire\Microfinance\Echeances;
use Livewire\Component;
use \App\Traits\EcheanceTrait;
use \App\Models\Echeance;
use Livewire\WithPagination;
class EcheanceListe extends Component {
use EcheanceTrait;
use WithPagination;

       protected $paginationTheme = 'bootstrap';protected $listeners = ['unecheanceUpdate' => 'refresh'];
public function refresh(){
    $this->echeances = \App\Models\Echeance::orderBy('code','asc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\Echeance::query();
	if($this->search!==null) 
	$qr=\App\Models\Echeance::where('date_echeance',$this->search);
	$this->echeances=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unecheance=\App\Models\Echeance::find($this->sid);
	return view('livewire.microfinance.echeances.echeance-liste',
	   ['echeances'=>$this->echeances,'echeance'=>$this->unecheance]);
}

public function resetEcheance() {
	 $this->date_echeance  = '';
	 $this->montant_paye  = '';
}
}