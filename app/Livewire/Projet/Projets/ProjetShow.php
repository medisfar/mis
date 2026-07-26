<?php
namespace App\Livewire\Projet\Projets;
use Livewire\Component;
use \App\Traits\ProjetTrait;
use \App\Models\Projet;
class ProjetShow extends Component {
use ProjetTrait;
public $b,$mtn,$date_f;
public function mount($id) {
	$this->sid=$id;
	$this->editProjet($this->sid);}
public function render() {
	$qr=\App\Models\Projet::query();
	$this->projets=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unprojet=\App\Models\Projet::find($this->sid);

	return view('livewire.projet.projets.projet-show',
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

public function add(){
	$p=\App\Models\Projet::find($this->sid);
	$p->bailleurs()->attach($this->b,['date_f'=>$this->date_f,'budget'=>$this->mtn]);
}
public function del($idp){
 \DB::delete('delete from bailleur_projet where projet_id=? and bailleur_id=?',[$this->sid,$idp]);
}
}