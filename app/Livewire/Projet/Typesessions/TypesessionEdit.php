<?php
namespace App\Livewire\Projet\Typesessions;
use Livewire\Component;
use \App\Traits\TypesessionTrait;
use \App\Models\Typesession;
class TypesessionEdit extends Component {
use TypesessionTrait;
public function mount($id) {
	$this->sid=$id;
	$this->editTypesession($this->sid);}
protected $listeners = ['untypesessionUpdate' => 'refresh'];
public function refresh(){
    $this->typesessions = \App\Models\Typesession::orderBy('code','asc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\Typesession::query();
	$this->typesessions=$qr->paginate(20);
	if($this->sid!==null) 
	$this->untypesession=\App\Models\Typesession::find($this->sid);
	return view('livewire.projet.typesessions.typesession-edit',
	   ['typesessions'=>$this->typesessions,'typesession'=>$this->untypesession]);
}

public function resetTypesession() {
	 $this->nom  = '';
}
}