<?php
namespace App\Livewire\Projet\Souscomposantes;
use Livewire\Component;
use \App\Traits\SouscomposanteTrait;
use \App\Models\Souscomposante;
class SouscomposanteAdd extends Component {
use SouscomposanteTrait;
public function render() {
	$qr=\App\Models\Souscomposante::query();
	if(request()->has('idm')) 
	$this->composante_id=request()->get('idm',0);
	$this->souscomposantes=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unsouscomposante=\App\Models\Souscomposante::find($this->sid);
	$this->createSouscomposante($this->sid);	return view('livewire.projet.souscomposantes.souscomposante-add',
	   ['souscomposantes'=>$this->souscomposantes,'souscomposante'=>$this->unsouscomposante]);
}

public function resetSouscomposante() {
	 $this->code  = '';
	 $this->description  = '';
	 $this->composante_id  = '';
}
}