<?php
namespace App\Livewire\Pret\Echeances;
use Livewire\Component;
use \App\Traits\EcheanceTrait;
use \App\Models\Echeance;
class EcheanceShow extends Component {
use EcheanceTrait;
public function mount($id) {
	$this->sid=$id;
	$this->editEcheance($this->sid);}
protected $listeners = ['unecheanceUpdate' => 'refresh'];
public function refresh(){
    $this->echeances = \App\Models\Echeance::orderBy('code','asc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\Echeance::query();
	$this->echeances=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unecheance=\App\Models\Echeance::find($this->sid);
	return view('livewire.pret.echeances.echeance-show',
	   ['echeances'=>$this->echeances,'echeance'=>$this->unecheance]);
}

public function resetEcheance() {
	 $this->membre_id  = '';
	 $this->montant  = '';
	 $this->date_paiement  = '';
}
}