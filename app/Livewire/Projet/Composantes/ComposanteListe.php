<?php
namespace App\Livewire\Projet\Composantes;
use Livewire\Component;
use \App\Traits\ComposanteTrait;
use \App\Models\Composante;
use Livewire\WithPagination;
class ComposanteListe extends Component {
use ComposanteTrait;
use WithPagination;

       protected $paginationTheme = 'bootstrap';
       protected $listeners = ['composanteUpdate' => 'refresh'];
public function refresh(){
    $this->composantes = \App\Models\Composante::orderBy('code','asc')->paginate(20);
    $this->render();
}
       public function render() {
	$qr=\App\Models\Composante::query();
	$qr->where('projet_id', session()->get('pid'));
	if($this->pid!==null) 
	$qr->where('projet_id',$this->pid);
	if($this->search!==null) 
	$qr=\App\Models\Composante::where('projet_id',$this->search);
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