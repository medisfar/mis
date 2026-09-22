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
    $this->groupements = \App\Models\Groupement::leftJoin('sites', 'sites.id', '=', 'groupements.site_id')
        ->where('groupements.projet_id', session()->get('pid'))
        ->select('groupements.*')
        ->orderBy('sites.nom','asc')
        ->orderBy('groupements.nom_groupe','asc')
        ->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\Groupement::leftJoin('sites', 'sites.id', '=', 'groupements.site_id')
        ->where('groupements.projet_id', session()->get('pid'))
        ->select('groupements.*');
	if($this->search!==null)
	$qr->where('nom_groupe','like',$this->search.'%');
	$qr->orderBy('sites.nom', 'asc')->orderBy('groupements.nom_groupe', 'asc');
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
