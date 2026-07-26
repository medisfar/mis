<?php
namespace App\Livewire\Projet\Decomptes;
use Livewire\Component;
use \App\Traits\DecompteTrait;
use \App\Models\Decompte;
class DecompteAdd extends Component {
use DecompteTrait;
public function render() {
	if(request()->has('idm')) $this->activite=request()->get('idm',0);
	$qr=\App\Models\Decompte::query();
	$this->decomptes=$qr->paginate(20);
	if($this->sid!==null) 
	$this->undecompte=\App\Models\Decompte::find($this->sid);
	$this->createDecompte($this->sid);	return view('livewire.projet.decomptes.decompte-add',
	   ['decomptes'=>$this->decomptes,'decompte'=>$this->undecompte]);
}

public function resetDecompte() {
	 $this->activite_id  = '';
	 $this->date_previsionnelle  = '';
	 $this->pourcentage  = '';
	 $this->date_effective  = '';
}
}