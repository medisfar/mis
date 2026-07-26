<?php
namespace App\Livewire\Monitoring\Composantes;
use Livewire\Component;
use \App\Traits\ComposanteTrait;
use \App\Models\Composante;
class ComposanteEdit extends Component {
use ComposanteTrait;
public function mount($id) {
	$this->sid=$id;
	$this->editComposante($this->sid);}
protected $listeners = ['uncomposanteUpdate' => 'refresh'];
public function refresh(){
    $this->composantes = \App\Models\Composante::orderBy('code','asc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\Composante::query();
	$this->composantes=$qr->paginate(20);
	if($this->sid!==null) 
	$this->uncomposante=\App\Models\Composante::find($this->sid);
	return view('livewire.monitoring.composantes.composante-edit',
	   ['composantes'=>$this->composantes,'composante'=>$this->uncomposante]);
}

public function resetComposante() {
	 $this->code  = '';
	 $this->description  = '';
	 $this->projet_id  = '';
}
}