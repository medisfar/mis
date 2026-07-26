<?php
namespace App\Livewire\Projet\Projets;
use Livewire\Component;
use \App\Traits\ProjetTrait;
use \App\Models\Projet;
class ProjetAdd extends Component {
use ProjetTrait;
public function render() {
	$qr=\App\Models\Projet::query();
	$this->projets=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unprojet=\App\Models\Projet::find($this->sid);
	$this->createProjet($this->sid);	return view('livewire.projet.projets.projet-add',
	   ['projets'=>$this->projets,'projet'=>$this->unprojet]);
}

public function resetProjet() {
	 $this->code  = '';
	 $this->nom_projet  = '';
	 $this->budget  = '';
	 $this->date_debut  = '';
	 $this->date_fin  = '';
	 $this->statut  = '';
}
}