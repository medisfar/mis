<?php
namespace App\Livewire\Projet\Indicateurs;
use Livewire\Component;
use \App\Traits\IndicateurTrait;
use \App\Models\Indicateur;
class IndicateurEdit extends Component {
use IndicateurTrait;
public function mount($id) {
	$this->sid=$id;
	$this->editIndicateur($this->sid);}
protected $listeners = ['unindicateurUpdate' => 'refresh'];
public function refresh(){
    $this->indicateurs = \App\Models\Indicateur::orderBy('code','asc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\Indicateur::query();
	$this->indicateurs=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unindicateur=\App\Models\Indicateur::find($this->sid);
	$this->cid=$this->unindicateur->composante_id;
	return view('livewire.projet.indicateurs.indicateur-edit',
	   ['indicateurs'=>$this->indicateurs,'indicateur'=>$this->unindicateur]);
}

public function resetIndicateur() {
	 $this->activite_id  = '';
	 $this->nom  = '';
	 $this->frequence  = '';
	 $this->unite_mesure  = '';
	 $this->baseline  = '';
	 $this->cible_finale  = '';
	 $this->valeur_actuelle  = '';
	 $this->niveau  = '';
	 $this->source  = '';
}
}