<?php
namespace App\Livewire\Projet\Composantes;
use Livewire\Component;
use \App\Traits\composanteTrait;
use \App\Models\composante;
class composanteEdit extends Component {
use composanteTrait;
public function mount($id) {
	$this->sid=$id;
	$this->editcomposante($this->sid);}
public function render() {
	$qr=\App\Models\composante::query();
	$this->composantes=$qr->paginate(20);
	if($this->sid!==null) 
	$this->uncomposante=\App\Models\composante::find($this->sid);
	return view('livewire.projet.composantes.composante-edit',
	   ['composantes'=>$this->composantes,'composante'=>$this->uncomposante]);
}

public function resetcomposante() {
	 $this->code  = '';
	 $this->description  = '';
	 $this->projet_id  = '';
}
}