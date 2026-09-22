<?php
namespace App\Livewire\Microfinance\Paiements;
use Livewire\Component;
use \App\Traits\PaiementTrait;
use \App\Models\Paiement;
use Livewire\WithPagination;
class PaiementListe extends Component {
use PaiementTrait;
use WithPagination;

       protected $paginationTheme = 'bootstrap';protected $listeners = ['unpaiementUpdate' => 'refresh'];
public function refresh(){
    $this->paiements = \App\Models\Paiement::orderBy('code','asc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\Paiement::query();
	if($this->search!==null) 
	$qr=\App\Models\Paiement::where('credit',$this->search);
	$this->paiements=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unpaiement=\App\Models\Paiement::find($this->sid);
	return view('livewire.microfinance.paiements.paiement-liste',
	   ['paiements'=>$this->paiements,'paiement'=>$this->unpaiement]);
}

public function resetPaiement() {
	 $this->credit  = '';
	 $this->date_paiement  = '';
	 $this->montant_paye  = '';
	 $this->montant_restant  = '';
}
}