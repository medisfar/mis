<?php
namespace App\Livewire\Pret\Echeances;
use Livewire\Component;
use \App\Traits\EcheanceTrait;
use \App\Models\Echeance;
class EcheanceAdd extends Component {
use EcheanceTrait;
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
	$this->createEcheance($this->sid);	return view('livewire.pret.echeances.echeance-add',
	   ['echeances'=>$this->echeances,'echeance'=>$this->unecheance]);
}

public function resetEcheance() {
	 $this->membre_id  = '';
	 $this->montant  = '';
	 $this->date_paiement  = '';
}
}