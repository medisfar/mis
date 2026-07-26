<?php
namespace App\Livewire\Datacollect\Membres;
use Livewire\Component;
use \App\Traits\MembreTrait;
use \App\Models\Membre;
class MembreEdit extends Component {
use MembreTrait;
public function mount($id) {
	$this->sid=$id;
	$this->editMembre($this->sid);}
protected $listeners = ['unmembreUpdate' => 'refresh'];
public function refresh(){
    $this->membres = \App\Models\Membre::orderBy('code','asc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\Membre::query();
	$this->membres=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unmembre=\App\Models\Membre::find($this->sid);
	return view('livewire.datacollect.membres.membre-edit',
	   ['membres'=>$this->membres,'membre'=>$this->unmembre]);
}

public function resetMembre() {
	 $this->menage_id  = '';
	 $this->genre  = '';
	 $this->nom  = '';
	 $this->date_naissance  = '';
	 $this->lien_parente  = '';
	 $this->enceinte  = '';
}
}