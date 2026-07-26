<?php
namespace App\Livewire\Datacollect\Groupenents;
use Livewire\Component;
use \App\Traits\GroupementTrait;
use \App\Models\Groupement;
use Livewire\WithPagination;
class GroupementListe extends Component {
use GroupementTrait;
use WithPagination;

       protected $paginationTheme = 'bootstrap';protected $listeners = ['ungroupementUpdate' => 'refresh'];
public function refresh(){
    $this->groupenents = \App\Models\Groupement::orderBy('code','asc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\Groupement::query();
	if($this->search!==null) 
	$qr=\App\Models\Groupement::where('',$this->search);
	$this->groupenents=$qr->paginate(20);
	if($this->sid!==null) 
	$this->ungroupement=\App\Models\Groupement::find($this->sid);
	return view('livewire.datacollect.groupenents.groupement-liste',
	   ['groupenents'=>$this->groupenents,'groupement'=>$this->ungroupement]);
}

public function resetGroupement() {
}
}