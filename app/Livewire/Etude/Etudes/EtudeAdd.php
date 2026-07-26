<?php
namespace App\Livewire\Etude\Etudes;
use Livewire\Component;
use \App\Traits\EtudeTrait;
use \App\Models\Etude;
class EtudeAdd extends Component {
use EtudeTrait;
protected $listeners = ['unetudeUpdate' => 'refresh'];
public function refresh(){
    $this->etudes = \App\Models\Etude::orderBy('code','asc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\Etude::query();
	$this->etudes=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unetude=\App\Models\Etude::find($this->sid);
	$this->createEtude($this->sid);	return view('livewire.etude.etudes.etude-add',
	   ['etudes'=>$this->etudes,'etude'=>$this->unetude]);
}

public function resetEtude() {
	 $this->projet_id  = '';
	 $this->categorie  = '';
	 $this->nom  = '';
	 $this->objectif  = '';
	 $this->methologie  = '';
	 $this->resultats_principaux  = '';
	 $this->reommendations_cles  = '';
	 $this->date_debut  = '';
	 $this->date_fin  = '';
	 $this->statut  = '';
	 $this->Zones  = '';
	 $this->partenaire  = '';
	 $this->lecons_apprises  = '';
}
}