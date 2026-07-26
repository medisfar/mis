<?php
namespace App\Livewire\Datacollect\Donnees;
use Livewire\Component;
use \App\Traits\DonneeTrait;
use \App\Models\Donnee;
class DonneeAdd extends Component {
use DonneeTrait;
protected $listeners = ['undonneeUpdate' => 'refresh'];
public function refresh(){
    $this->lesdonnees = \App\Models\Donnee::orderBy('code','asc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\Donnee::query();
	$this->lesdonnees=$qr->paginate(20);
	if($this->sid!==null) 
	$this->undonnee=\App\Models\Donnee::find($this->sid);
	$this->createDonnee($this->sid);	return view('livewire.datacollect.donnees.donnee-add',
	   ['donnees'=>$this->lesdonnees,'donnee'=>$this->undonnee]);
}

public function resetDonnee() {
	 $this->collecte_id  = '';
	 $this->session_id  = '';
	 $this->membre_id  = '';
	 $this->date_session  = '';
	 $this->donnees  = '';
}
}