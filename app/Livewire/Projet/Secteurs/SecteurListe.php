<?php
namespace App\Livewire\Projet\Secteurs;
use Livewire\Component;
use \App\Traits\SecteurTrait;
use \App\Models\Secteur;
use Livewire\WithPagination;
class SecteurListe extends Component {
use SecteurTrait;
use WithPagination;

       protected $paginationTheme = 'bootstrap';protected $listeners = ['unsecteurUpdate' => 'refresh'];
public function refresh(){
    $this->secteurs = \App\Models\Secteur::orderBy('code','asc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\Secteur::query();
	if($this->search!==null) 
	$qr=\App\Models\Secteur::where('nom_secteur',$this->search);
	$this->secteurs=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unsecteur=\App\Models\Secteur::find($this->sid);
	return view('livewire.projet.secteurs.secteur-liste',
	   ['secteurs'=>$this->secteurs,'secteur'=>$this->unsecteur]);
}

public function resetSecteur() {
	 $this->nom_secteur  = '';
	 $this->mission_id  = '';
}
}