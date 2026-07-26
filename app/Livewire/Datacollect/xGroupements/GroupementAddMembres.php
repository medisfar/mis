<?php
namespace App\Livewire\Datacollect\Groupements;
use Livewire\Component;
use \App\Traits\GroupementTrait;
use \App\Models\Groupement;
class GroupementAddMembres extends Component {
use GroupementTrait;
public $sps=[];
public function mount($id) {
	$this->sid=$id;
	$this->editGroupement($this->sid);}
public function render() {
	$qr=\App\Models\Groupement::query();
	$this->groupements=$qr->paginate(20);
	if($this->sid!==null) 
	$this->ungroupement=\App\Models\Groupement::find($this->sid);
$localite = $this->ungroupement->site->localite; 
 // dd($localite);
	return view('livewire.datacollect.groupements.groupement-add-membres',
	   ['groupements'=>$this->groupements,'groupement'=>$this->ungroupement,'localite'=>$localite]);
}

public function save($id){
	//dd($this->sps);
	$gr=\App\Models\Groupement::find($this->sid);
	$gr->membres()->syncWithoutDetaching(array_keys($this->sps));
	return Redirect()->route('datacollect.groupements.show',$id);
}
public function resetGroupement() {
	 $this->nom_groupe  = '';
}
}