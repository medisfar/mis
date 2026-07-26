<?php
namespace App\Livewire\Projet\Composantes;
use Livewire\Component;
use \App\Traits\ComposanteTrait;
use \App\Models\Composante;
use Livewire\WithPagination;
class ComposanteListe extends Component {
use ComposanteTrait;
use WithPagination;

       protected $paginationTheme = 'bootstrap';public function render() {
	$qr=\App\Models\Composante::query();
	if($this->search!==null) 
	$qr=\App\Models\Composante::where('code',$this->search);
	$this->composantes=$qr->paginate(20);
	if($this->sid!==null) 
	$this->uncomposante=\App\Models\Composante::find($this->sid);
	return view('livewire.projet.composantes.composante-liste',
	   ['composantes'=>$this->composantes,'composante'=>$this->uncomposante]);
}

public function resetComposante() {
	 $this->code  = '';
	 $this->description  = '';
	 $this->projet_id  = '';
}
}