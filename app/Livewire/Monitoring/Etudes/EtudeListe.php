<?php
namespace App\Livewire\Monitoring\Etudes;
use Livewire\Component;
use \App\Traits\EtudeTrait;
use \App\Models\Etude;
use Livewire\WithPagination;
class EtudeListe extends Component {
use EtudeTrait;
use WithPagination;

       protected $paginationTheme = 'bootstrap';protected $listeners = ['unetudeUpdate' => 'refresh'];
public function refresh(){
    $this->etudes = \App\Models\Etude::orderBy('code','asc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\Etude::query();
	if($this->search!==null) 
	$qr=\App\Models\Etude::where('projet_id',$this->search);
	$this->etudes=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unetude=\App\Models\Etude::find($this->sid);
	return view('livewire.monitoring.etudes.etude-liste',
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