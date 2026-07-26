<?php
namespace App\Livewire\Projet\Souscomposantes;
use Livewire\Component;
use \App\Traits\SouscomposanteTrait;
use \App\Models\Souscomposante;
use Livewire\WithPagination;
class SouscomposanteListe extends Component {
use SouscomposanteTrait;
use WithPagination;

       protected $paginationTheme = 'bootstrap';public function render() {
	$qr=\App\Models\Souscomposante::query();
		$qr->where('composante_id',$this->cid);
	if($this->search!==null) 
	$qr->where('code',$this->search);
	if($this->composante_id!=null)
	$qr->where('composante_id',$this->composante_id);
	$this->souscomposantes=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unsouscomposante=\App\Models\Souscomposante::find($this->sid);
	return view('livewire.projet.souscomposantes.souscomposante-liste',
	   ['souscomposantes'=>$this->souscomposantes,'souscomposante'=>$this->unsouscomposante]);
}

public function resetSouscomposante() {
	 $this->code  = '';
	 $this->description  = '';
	 $this->composante_id  = '';
}
}