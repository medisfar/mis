<?php
namespace App\Livewire\Datacollect\Groupenents;
use Livewire\Component;
use \App\Traits\GroupementTrait;
use \App\Models\Groupement;
class GroupementAdd extends Component {
use GroupementTrait;
protected $listeners = ['ungroupementUpdate' => 'refresh'];
public function refresh(){
    $this->groupenents = \App\Models\Groupement::orderBy('code','asc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\Groupement::query();
	$this->groupenents=$qr->paginate(20);
	if($this->sid!==null) 
	$this->ungroupement=\App\Models\Groupement::find($this->sid);
	$this->createGroupement($this->sid);	return view('livewire.datacollect.groupenents.groupement-add',
	   ['groupenents'=>$this->groupenents,'groupement'=>$this->ungroupement]);
}

public function resetGroupement() {
}
}