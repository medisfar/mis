<?php
namespace App\Livewire\Microfinance\Epargnes;
use Livewire\Component;
use \App\Traits\EpargneTrait;
use \App\Models\Epargne;
class EpargneEdit extends Component {
use EpargneTrait;
public function mount($id) {
	$this->sid=$id;
	$this->editEpargne($this->sid);}
protected $listeners = ['unepargneUpdate' => 'refresh'];
public function refresh(){
    $this->epargnes = \App\Models\Epargne::orderBy('code','asc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\Epargne::query();
	$this->epargnes=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unepargne=\App\Models\Epargne::find($this->sid);
	return view('livewire.microfinance.epargnes.epargne-edit',
	   ['epargnes'=>$this->epargnes,'epargne'=>$this->unepargne]);
}

public function resetEpargne() {
	 $this->membre_id  = '';
	 $this->date_operation  = '';
	 $this->type  = '';
	 $this->montant  = '';
}
}