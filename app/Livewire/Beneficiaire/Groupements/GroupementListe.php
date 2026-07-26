<?php
namespace App\Livewire\Beneficiaire\Groupements;
use Livewire\Component;
use \App\Traits\GroupementTrait;
use \App\Models\Groupement;
use Livewire\WithPagination;
class GroupementListe extends Component {
use GroupementTrait;
use WithPagination;

       protected $paginationTheme = 'bootstrap';protected $listeners = ['groupementUpdate' => 'refresh'];
public function refresh(){
    $this->groupements = \App\Models\Groupement::orderBy('nom_groupe','asc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\Groupement::query();
	if($this->search!==null) 
	$qr=\App\Models\Groupement::where('nom_groupe','like',$this->search.'%');
	$this->groupements=$qr->paginate(20);
	if($this->sid!==null) 
	$this->ungroupement=\App\Models\Groupement::find($this->sid);
	return view('livewire.beneficiaire.groupements.groupement-liste',
	   ['groupements'=>$this->groupements,'groupement'=>$this->ungroupement]);
}

public function resetGroupement() {
	 $this->nom_groupe  = '';
	 $this->site_id  = '';
	 $this->statut  = '';
}
}