<?php
namespace App\Livewire\Projet\Indicateurs;
use Livewire\Component;
use \App\Traits\IndicateurTrait;
use \App\Models\Indicateur;
class IndicateurAdd extends Component {
use IndicateurTrait;
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
	$this->createIndicateur($this->sid);	return view('livewire.projet.indicateurs.indicateur-add',
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