<?php
namespace App\Livewire\Datacollect\Groupements;
use Livewire\Component;
use \App\Traits\GroupementTrait;
use \App\Models\Groupement;
class GroupementEdit extends Component {
use GroupementTrait;
public function mount($id) {
	$this->sid=$id;
	$this->editGroupement($this->sid);}
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
	return view('livewire.datacollect.groupements.groupement-edit',
	   ['groupements'=>$this->groupements,'groupement'=>$this->ungroupement]);
}

public function resetGroupement() {
	 $this->nom_groupe  = '';
	 $this->site_id  = '';
	 $this->statut  = '';
}
}