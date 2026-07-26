<?php
namespace App\Livewire\Datacollect\Groupenents;
use Livewire\Component;
use \App\Traits\GroupementTrait;
use \App\Models\Groupement;
class GroupementShow extends Component {
use GroupementTrait;
public function mount($id) {
	$this->sid=$id;
	$this->editGroupement($this->sid);}
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
	return view('livewire.datacollect.groupenents.groupement-show',
	   ['groupenents'=>$this->groupenents,'groupement'=>$this->ungroupement]);
}

public function resetGroupement() {
}
}