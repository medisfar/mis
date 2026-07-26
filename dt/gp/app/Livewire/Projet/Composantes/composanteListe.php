<?php
namespace App\Livewire\Projet\Composantes;
use Livewire\Component;
use \App\Traits\composanteTrait;
use \App\Models\composante;
use Livewire\WithPagination;
class composanteListe extends Component {
use composanteTrait;
use WithPagination;

       protected $paginationTheme = 'bootstrap';public function render() {
	$qr=\App\Models\composante::query();
	if($this->search!==null) 
	$qr=\App\Models\composante::where('code',$this->search);
	$this->composantes=$qr->paginate(20);
	if($this->sid!==null) 
	$this->uncomposante=\App\Models\composante::find($this->sid);
	return view('livewire.projet.composantes.composante-liste',
	   ['composantes'=>$this->composantes,'composante'=>$this->uncomposante]);
}

public function resetcomposante() {
	 $this->code  = '';
	 $this->description  = '';
	 $this->projet_id  = '';
}
}