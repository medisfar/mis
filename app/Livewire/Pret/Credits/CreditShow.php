<?php
namespace App\Livewire\Pret\Credits;
use Livewire\Component;
use \App\Traits\CreditTrait;
use \App\Models\Credit;
class CreditShow extends Component {
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
	return view('livewire.pret.credits.credit-show',
	   ['credits'=>$this->credits,'credit'=>$this->uncredit]);
}

public function resetCredit() {
	 $this->membre_id  = '';
	 $this->date_credit  = '';
	 $this->montant  = '';
	 $this->nbre_echeance  = '';
}
}