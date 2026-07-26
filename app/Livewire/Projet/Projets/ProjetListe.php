<?php
namespace App\Livewire\Projet\Projets;
use Livewire\Component;
use \App\Traits\ProjetTrait;
use \App\Models\Projet;
use Livewire\WithPagination;
class ProjetListe extends Component {
use ProjetTrait;
use WithPagination;

 protected $listeners = ['projetUpdate' => 'refresh'];

public function refresh(){
    $this->regions=\App\Models\Projet::orderBy('code','asc')->paginate(20);
    $this->render();
   
}      protected $paginationTheme = 'bootstrap';public function render() {
	$qr=\App\Models\Projet::query();
	$qr->where('id', session()->get('pid'));
	if($this->search!==null) 
	$qr=\App\Models\Projet::where('code',$this->search);
	$this->projets=$qr->orderBy('date_debut','desc')->paginate(20);
	if($this->sid!==null) 
	$this->unprojet=\App\Models\Projet::find($this->sid);
	return view('livewire.projet.projets.projet-liste',
	   ['projets'=>$this->projets,'projet'=>$this->unprojet]);
}

public function resetProjet() {
	 $this->code  = '';
	 $this->libelle  = '';
	 $this->nom_projet  = '';
	 $this->objectifs  = '';
	 $this->budget  = '';
	 $this->date_debut  = '';
	 $this->date_fin  = '';
	 $this->l_statut  = '';
	 $this->commentaire  = '';
}
}