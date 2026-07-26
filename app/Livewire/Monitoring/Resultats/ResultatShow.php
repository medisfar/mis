<?php
namespace App\Livewire\Monitoring\Resultats;
use Livewire\Component;
use \App\Traits\ResultatTrait;
use \App\Models\Resultat;
class ResultatShow extends Component {
use ResultatTrait;
public function mount($id) {
	$this->sid=$id;
	$this->editResultat($this->sid);}
protected $listeners = ['unresultatUpdate' => 'refresh'];
public function refresh(){
    $this->resultats = \App\Models\Resultat::orderBy('code','asc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\Resultat::query();
	$this->resultats=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unresultat=\App\Models\Resultat::find($this->sid);
	return view('livewire.monitoring.resultats.resultat-show',
	   ['resultats'=>$this->resultats,'resultat'=>$this->unresultat]);
}

public function resetResultat() {
	 $this->description  = '';
}
}