<?php
namespace App\Livewire\Datacollect\Collectes;
use Livewire\Component;
use \App\Traits\CollecteTrait;
use \App\Models\Collecte;
class CollecteEdit extends Component {
use CollecteTrait;
public function mount($id) {
	$this->sid=$id;
	$this->editCollecte($this->sid);}
protected $listeners = ['uncollecteUpdate' => 'refresh'];
public function refresh(){
    $this->collectes = \App\Models\Collecte::orderBy('code','asc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\Collecte::query();
	$this->collectes=$qr->paginate(20);
	if($this->sid!==null) 
	$this->uncollecte=\App\Models\Collecte::find($this->sid);
	return view('livewire.datacollect.collectes.collecte-edit',
	   ['collectes'=>$this->collectes,'collecte'=>$this->uncollecte]);
}

public function resetCollecte() {
	 $this->projet_id  = '';
	 $this->site_id  = '';
}
}