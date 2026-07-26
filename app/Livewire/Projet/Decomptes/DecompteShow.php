<?php
namespace App\Livewire\Projet\Decomptes;
use Livewire\Component;
use \App\Traits\DecompteTrait;
use \App\Models\Decompte;
class DecompteShow extends Component {
use DecompteTrait;
public function mount($id) {
	$this->sid=$id;
	$this->editDecompte($this->sid);}
public function render() {
	$qr=\App\Models\Decompte::query();
	$this->decomptes=$qr->paginate(20);
	if($this->sid!==null) 
	$this->undecompte=\App\Models\Decompte::find($this->sid);
	return view('livewire.projet.decomptes.decompte-show',
	   ['decomptes'=>$this->decomptes,'decompte'=>$this->undecompte]);
}

public function resetDecompte() {
	 $this->activite_id  = '';
	 $this->date_previsionnelle  = '';
	 $this->pourcentage  = '';
	 $this->date_effective  = '';
}
}