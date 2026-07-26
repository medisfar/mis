<?php
namespace App\Livewire\DataCollect\Donnees;
use Livewire\Component;
use \App\Traits\DonneeTrait;
use \App\Models\Donnee;
class DonneeAdd extends Component {
use DonneeTrait;
protected $listeners = ['undonneeUpdate' => 'refresh'];
public function refresh(){
    $this->donnees = \App\Models\Donnee::orderBy('code','asc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\Donnee::query();
	$this->donnees=$qr->paginate(20);
	if($this->sid!==null) 
	$this->undonnee=\App\Models\Donnee::find($this->sid);
	$this->createDonnee($this->sid);	return view('livewire.dataCollect.donnees.donnee-add',
	   ['donnees'=>$this->donnees,'donnee'=>$this->undonnee]);
}

public function resetDonnee() {
	 $this->site_id  = '';
	 $this->groupement_id  = '';
	 $this->session_id  = '';
	 $this->membre_id  = '';
	 $this->metadonnees  = '';
}
}