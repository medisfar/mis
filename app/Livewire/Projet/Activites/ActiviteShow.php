<?php
namespace App\Livewire\Projet\Activites;
use Livewire\Component;
use \App\Traits\ActiviteTrait;
use \App\Models\Activite;
class ActiviteShow extends Component {
use ActiviteTrait;
public $nom,$pnom,$lbudget;
public function mount($id) {
	$this->sid=$id;
	$this->editActivite($this->sid);}
public function render() {
    
	$qr=\App\Models\Activite::query();
	$this->activites=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unactivite=\App\Models\Activite::find($this->sid);
//	dd($this->unactivite);
	return view('livewire.projet.activites.activite-show',
	   ['activites'=>$this->activites,'uneactivite'=>$this->unactivite]);
}
#{on('activiteUpdate')]
public function upt(){
    $this-->render();
}
public function resetActivite() {
	 $this->activite  = '';
	 $this->composante_id  = '';
	 $this->sous_composante_id  = '';
	 $this->date_debut  = '';
	 $this->date_fin  = '';
	 $this->budget  = '';
	  $this->engage  = '';
	 $this->completed  = '';
}
public function  addsite(){
  $a=\App\Models\Activite::find($this->sid);
  $a->sites()->attach($this->nom,['budget'=>$this->lbudget]);
  $this->render();
}
public function  delsite(){
    
    $a=\App\Models\Activite::find($this->sid);
  $a->sites()->detach($this->nom);
  
  $this->render();
}

public function  addproduit(){
  $a=\App\Models\Activite::find($this->sid);
  $a->produits()->attach($this->pnom);
  $this->render();
}
public function  delproduit(){
    
    $a=\App\Models\Activite::find($this->sid);
  $a->produits()->detach($this->nom);
  
  $this->render();
}
}