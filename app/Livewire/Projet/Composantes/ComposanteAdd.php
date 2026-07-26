<?php
namespace App\Livewire\Projet\Composantes;
use Livewire\Component;
use \App\Traits\ComposanteTrait;
use \App\Models\Composante;
class ComposanteAdd extends Component {
use ComposanteTrait;
public function render() {
	$qr=\App\Models\Composante::query();
	if(request()->has('idm')) $this->projet_id=request()->get('idm',0);
	$this->composantes=$qr->paginate(20);
	if($this->sid!==null) 
	$this->uncomposante=\App\Models\Composante::find($this->sid);
    
	$this->createComposante($this->sid);	return view('livewire.projet.composantes.composante-add',
	   ['composantes'=>$this->composantes,'composante'=>$this->uncomposante]);
}

public function resetComposante() {
	 $this->code  = '';
	 $this->description  = '';
	 $this->projet_id  = '';
}
}