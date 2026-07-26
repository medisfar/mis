<?php
namespace App\Livewire\Projet\Projets;
use Livewire\Component;
use \App\Traits\ProjetTrait;
use \App\Models\Projet;
use Livewire\WithPagination;
class ProjetListe extends Component {
use ProjetTrait;
use WithPagination;

       protected $paginationTheme = 'bootstrap';public function render() {
	$qr=\App\Models\Projet::query();
	if($this->search!==null) 
	$qr=\App\Models\Projet::where('code',$this->search);
	$this->projets=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unprojet=\App\Models\Projet::find($this->sid);
	return view('livewire.projet.projets.projet-liste',
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