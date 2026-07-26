<?php
namespace App\Livewire\Datacollect\Formulaires;
use Livewire\Component;
use \App\Traits\FormulaireTrait;
use \App\Models\Formulaire;
class FormulaireShow extends Component {
use FormulaireTrait;
public function mount($id) {
	$this->sid=$id;
	$this->editFormulaire($this->sid);}
protected $listeners = ['unformulaireUpdate' => 'refresh'];
public function refresh(){
    $this->formulaires = \App\Models\Formulaire::orderBy('code','asc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\Formulaire::query();
	$this->formulaires=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unformulaire=\App\Models\Formulaire::find($this->sid);
	return view('livewire.datacollect.formulaires.formulaire-show',
	   ['formulaires'=>$this->formulaires,'formulaire'=>$this->unformulaire]);
}

public function resetFormulaire() {
	 $this->nom  = '';
	 $this->projet_id  = '';
	 $this->fields  = '';
	 $this->actif  = '';
}
}