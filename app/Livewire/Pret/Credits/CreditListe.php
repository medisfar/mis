<?php
namespace App\Livewire\Pret\Credits;
use Livewire\Component;
use \App\Traits\CreditTrait;
use \App\Models\Credit;
use Livewire\WithPagination;
class CreditListe extends Component {
use CreditTrait;
use WithPagination;

       protected $paginationTheme = 'bootstrap';protected $listeners = ['uncreditUpdate' => 'refresh'];
public function refresh(){
    $this->credits = \App\Models\Credit::orderBy('code','asc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\Credit::query();
	if($this->search!==null) 
	$qr=\App\Models\Credit::where('membre_id',$this->search);
	$this->credits=$qr->paginate(20);
	if($this->sid!==null) 
	$this->uncredit=\App\Models\Credit::find($this->sid);
	return view('livewire.pret.credits.credit-liste',
	   ['credits'=>$this->credits,'credit'=>$this->uncredit]);
}

public function resetCredit() {
	 $this->membre_id  = '';
	 $this->date_credit  = '';
	 $this->montant  = '';
	 $this->nbre_echeance  = '';
}
}