<?php
namespace App\Livewire\Datacollect\Donnees;
use Livewire\Component;
use \App\Traits\DonneeTrait;
use \App\Models\Donnee;
use Livewire\WithPagination;
class DonneeListe extends Component {
use DonneeTrait;
use WithPagination;

       protected $paginationTheme = 'bootstrap';protected $listeners = ['undonneeUpdate' => 'refresh'];
public function refresh(){
    $this->lesdonnees = \App\Models\Donnee::orderBy('code','asc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\Donnee::query();
	if($this->search!==null) 
	$qr=\App\Models\Donnee::where('collecte_id',$this->search);
	$this->lesdonnees=$qr->paginate(20);
	if($this->sid!==null) 
	$this->undonnee=\App\Models\Donnee::find($this->sid);
	
	return view('livewire.datacollect.donnees.donnee-liste',
	   ['lesdonnees'=>$this->lesdonnees,'donnee'=>$this->undonnee]);
}

public function resetDonnee() {
	 $this->collecte_id  = '';
	 $this->session_id  = '';
	 $this->membre_id  = '';
	 $this->date_session  = '';
	 $this->donnees  = '';
}
}