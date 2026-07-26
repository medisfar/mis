<?php
namespace App\Livewire\Projet\Composantes;
use Livewire\Component;
use \App\Traits\ComposanteTrait;
use \App\Models\Composante;
class ComposanteShow extends Component {
use ComposanteTrait;
public function mount($id) {
	$this->sid=$id;
	$this->editComposante($this->sid);}
public function render() {
	$qr=\App\Models\Composante::query();
	$this->composantes=$qr->paginate(20);
	if($this->sid!==null) 
	$this->uncomposante=\App\Models\Composante::find($this->sid);
	return view('livewire.projet.composantes.composante-show',
	   ['composantes'=>$this->composantes,'composante'=>$this->uncomposante]);
}

public function resetComposante() {
	 $this->code  = '';
	 $this->description  = '';
	 $this->projet_id  = '';
}
}