<?php
namespace App\Livewire\Projet\Typesessions;
use Livewire\Component;
use \App\Traits\TypesessionTrait;
use \App\Models\Typesession;
use Livewire\WithPagination;
class TypesessionListe extends Component {
use TypesessionTrait;
use WithPagination;

       protected $paginationTheme = 'bootstrap';protected $listeners = ['untypesessionUpdate' => 'refresh'];
public function refresh(){
    $this->typesessions = \App\Models\Typesession::orderBy('code','asc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\Typesession::query();
	if($this->search!==null) 
	$qr=\App\Models\Typesession::where('nom',$this->search);
	$this->typesessions=$qr->paginate(20);
	if($this->sid!==null) 
	$this->untypesession=\App\Models\Typesession::find($this->sid);
	return view('livewire.projet.typesessions.typesession-liste',
	   ['typesessions'=>$this->typesessions,'typesession'=>$this->untypesession]);
}

public function resetTypesession() {
	 $this->nom  = '';
}
}