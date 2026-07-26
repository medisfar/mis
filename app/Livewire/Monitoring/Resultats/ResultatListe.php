<?php
namespace App\Livewire\Monitoring\Resultats;
use Livewire\Component;
use \App\Traits\ResultatTrait;
use \App\Models\Resultat;
use Livewire\WithPagination;
class ResultatListe extends Component {
use ResultatTrait;
use WithPagination;

       protected $paginationTheme = 'bootstrap';protected $listeners = ['unresultatUpdate' => 'refresh'];
public function refresh(){
    $this->resultats = \App\Models\Resultat::orderBy('code','asc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\Resultat::query();
	if($this->search!==null) 
	$qr=\App\Models\Resultat::where('description',$this->search);
	$this->resultats=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unresultat=\App\Models\Resultat::find($this->sid);
	return view('livewire.monitoring.resultats.resultat-liste',
	   ['resultats'=>$this->resultats,'resultat'=>$this->unresultat]);
}

public function resetResultat() {
	 $this->description  = '';
}
}