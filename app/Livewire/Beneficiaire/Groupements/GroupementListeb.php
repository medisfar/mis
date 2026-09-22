<?php
namespace App\Livewire\Beneficiaire\Groupements;
use Livewire\Component;
use \App\Traits\GroupementTrait;
use \App\Models\Groupement;
use Livewire\WithPagination;
class GroupementListeb extends Component {
use GroupementTrait;
use WithPagination;
public $siid,$lid;
       protected $paginationTheme = 'bootstrap';protected $listeners = ['groupementUpdate' => 'refresh'];
public function refresh(){
    $this->groupements = \App\Models\Groupement::where('projet_id', session()->get('pid'))
        ->orderBy('nom_groupe','asc')
        ->paginate(20);
    $this->render();
}
public function render() {
	$projetId = session()->get('pid');
	$qr=\App\Models\Groupement::where('projet_id', $projetId);
	if($this->search!==null)
	$qr->where('nom_groupe','like',$this->search.'%');
	

	if($this->siid!==null) 
	$qr->where('site_id',$this->siid);
	$ll=$this->lid;
	if($this->lid!==null) 
	$qr->wherehas('site',function($aar) use ($ll) { $aar->where('localite_id',$ll);});
	if($this->sid!==null) 
	$this->ungroupement=\App\Models\Groupement::find($this->sid);
	$this->groupements=$qr->orderBy('nom_groupe', 'asc')->paginate(20);
	$locs=[];
	$projet=\App\Models\Projet::find($projetId);
	if($projet && $projet->sites) {
	foreach($projet->sites as $s)
	  $locs[$s->localite->id]=utf8_decode($s->localite->nom_localite);
	}
	return view('livewire.beneficiaire.groupements.groupement-listeb',
	   ['groupements'=>$this->groupements,'groupement'=>$this->ungroupement,'locs'=>$locs]);
}

public function resetGroupement() {
	 $this->nom_groupe  = '';
	 $this->site_id  = '';
	 $this->statut  = '';
}
}
