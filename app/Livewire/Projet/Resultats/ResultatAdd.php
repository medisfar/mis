<?php
namespace App\Livewire\Projet\Resultats;
use Livewire\Component;
use \App\Traits\ResultatTrait;
use \App\Models\Resultat;
class ResultatAdd extends Component {
use ResultatTrait;
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
	$this->createResultat($this->sid);	return view('livewire.projet.resultats.resultat-add',
	   ['resultats'=>$this->resultats,'resultat'=>$this->unresultat]);
}

public function resetResultat() {
	 $this->projet_id  = '';
	 $this->description  = '';
}
}