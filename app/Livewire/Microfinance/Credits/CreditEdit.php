<?php
namespace App\Livewire\Microfinance\Credits;
use Livewire\Component;
use \App\Traits\CreditTrait;
use \App\Models\Credit;
class CreditEdit extends Component {
use CreditTrait;
public function mount($id) {
	$this->sid=$id;
	$this->editCredit($this->sid);}
protected $listeners = ['uncreditUpdate' => 'refresh'];
public function refresh(){
    $this->credits = \App\Models\Credit::orderBy('code','asc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\Credit::query();
	$this->credits=$qr->paginate(20);
	if($this->sid!==null) 
	$this->uncredit=\App\Models\Credit::find($this->sid);
	return view('livewire.microfinance.credits.credit-edit',
	   ['credits'=>$this->credits,'credit'=>$this->uncredit]);
}

public function resetCredit() {
	 $this->date_octroi  = '';
	 $this->date_premiere_echeance  = '';
	 $this->montant_echeance  = '';
	 $this->nbre_echeance  = '';
	 $this->termine  = '';
}
}