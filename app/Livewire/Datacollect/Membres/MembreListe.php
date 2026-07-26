<?php
namespace App\Livewire\Datacollect\Membres;
use Livewire\Component;
use \App\Traits\MembreTrait;
use \App\Models\Membre;
use Livewire\WithPagination;
class MembreListe extends Component {
use MembreTrait;
use WithPagination;

       protected $paginationTheme = 'bootstrap';protected $listeners = ['unmembreUpdate' => 'refresh'];
public function refresh(){
    $this->membres = \App\Models\Membre::orderBy('code','asc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\Membre::query();
	if($this->search!==null) 
	$qr=\App\Models\Membre::where('menage_id','like',$this->search.'%');
	$this->membres=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unmembre=\App\Models\Membre::find($this->sid);
	return view('livewire.datacollect.membres.membre-liste',
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