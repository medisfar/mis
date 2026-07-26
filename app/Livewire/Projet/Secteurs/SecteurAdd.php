<?php
namespace App\Livewire\Projet\Secteurs;
use Livewire\Component;
use \App\Traits\SecteurTrait;
use \App\Models\Secteur;
class SecteurAdd extends Component {
use SecteurTrait;
protected $listeners = ['unsecteurUpdate' => 'refresh'];
public function refresh(){
    $this->secteurs = \App\Models\Secteur::orderBy('code','asc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\Secteur::query();
	$this->secteurs=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unsecteur=\App\Models\Secteur::find($this->sid);
	$this->createSecteur($this->sid);	return view('livewire.projet.secteurs.secteur-add',
	   ['secteurs'=>$this->secteurs,'secteur'=>$this->unsecteur]);
}

public function resetSecteur() {
	 $this->nom_secteur  = '';
	 $this->mission_id  = '';
}
}