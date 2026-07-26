<?php
namespace App\Livewire\Monitoring\Decomptes;
use Livewire\Component;
use \App\Traits\DecompteTrait;
use \App\Models\Decompte;
class DecompteAdd extends Component {
use DecompteTrait;
protected $listeners = ['undecompteUpdate' => 'refresh'];
public function refresh(){
    $this->decomptes = \App\Models\Decompte::orderBy('code','asc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\Decompte::query();
	$this->decomptes=$qr->paginate(20);
	if($this->sid!==null) 
	$this->undecompte=\App\Models\Decompte::find($this->sid);
	$this->createDecompte($this->sid);	return view('livewire.monitoring.decomptes.decompte-add',
	   ['decomptes'=>$this->decomptes,'decompte'=>$this->undecompte]);
}

public function resetDecompte() {
	 $this->activite_id  = '';
	 $this->site_id  = '';
	 $this->montant  = '';
	 $this->date_effective  = '';
}
}