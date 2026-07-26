<?php
namespace App\Livewire\Datacollect\Groupements;
use Livewire\Component;
use \App\Traits\GroupementTrait;
use \App\Models\Groupement;
class GroupementAdd extends Component {
use GroupementTrait;
protected $listeners = ['ungroupementUpdate' => 'refresh'];
public function refresh(){
    $this->groupements = \App\Models\Groupement::orderBy('code','asc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\Groupement::query();
	$this->groupements=$qr->paginate(20);
	if($this->sid!==null) 
	$this->ungroupement=\App\Models\Groupement::find($this->sid);
	$this->createGroupement($this->sid);	return view('livewire.datacollect.groupements.groupement-add',
	   ['groupements'=>$this->groupements,'groupement'=>$this->ungroupement]);
}

public function resetGroupement() {
	 $this->projet_id  = '';
	 $this->nom_groupe  = '';
	 $this->site_id  = '';
	 $this->statut  = '';
}
}