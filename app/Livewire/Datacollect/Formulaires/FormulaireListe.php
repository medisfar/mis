<?php
namespace App\Livewire\Datacollect\Formulaires;
use Livewire\Component;
use \App\Traits\FormulaireTrait;
use \App\Models\Formulaire;
use Livewire\WithPagination;
class FormulaireListe extends Component {
use FormulaireTrait;
use WithPagination;

       protected $paginationTheme = 'bootstrap';protected $listeners = ['unformulaireUpdate' => 'refresh'];
public function refresh(){
    $this->formulaires = \App\Models\Formulaire::orderBy('code','asc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\Formulaire::query();
	if($this->search!==null) 
	$qr=\App\Models\Formulaire::where('nom',$this->search);
	$this->formulaires=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unformulaire=\App\Models\Formulaire::find($this->sid);
	return view('livewire.datacollect.formulaires.formulaire-liste',
	   ['formulaires'=>$this->formulaires,'formulaire'=>$this->unformulaire]);
}

public function resetFormulaire() {
	 $this->nom  = '';
	 $this->projet_id  = '';
	 $this->fields  = '';
	 $this->actif  = '';
}
}