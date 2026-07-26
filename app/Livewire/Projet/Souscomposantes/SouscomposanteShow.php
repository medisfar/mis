<?php
namespace App\Livewire\Projet\Souscomposantes;
use Livewire\Component;
use \App\Traits\SouscomposanteTrait;
use \App\Models\Souscomposante;
class SouscomposanteShow extends Component {
use SouscomposanteTrait;
public function mount($id) {
	$this->sid=$id;
	$this->editSouscomposante($this->sid);}
public function render() {
	$qr=\App\Models\Souscomposante::query();
	$this->souscomposantes=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unsouscomposante=\App\Models\Souscomposante::find($this->sid);
	return view('livewire.projet.souscomposantes.souscomposante-show',
	   ['souscomposantes'=>$this->souscomposantes,'souscomposante'=>$this->unsouscomposante]);
}

public function resetSouscomposante() {
	 $this->code  = '';
	 $this->description  = '';
	 $this->composante_id  = '';
}
}