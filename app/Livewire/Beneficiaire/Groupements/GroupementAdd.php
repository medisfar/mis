<?php
namespace App\Livewire\Beneficiaire\Groupements;
use Livewire\Component;
use \App\Traits\GroupementTrait;
use \App\Models\Groupement;
class GroupementAdd extends Component {
use GroupementTrait;

public $localite_id = null;
public $listeners = ['valueUpdated'=>'updateValue'];

public function mount(): void
{
    $this->projet_id = session()->get('pid');
}

  public function updateValue($value){
       
        $this->localite_id=$value;
    }
public function refresh(){
    $this->groupements = \App\Models\Groupement::orderBy('code','asc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\Groupement::query();
	$this->groupements=$qr->paginate(20);
	if($this->sid!==null) 
	$this->ungroupement=\App\Models\Groupement::find($this->sid);
	$this->createGroupement($this->sid);	return view('livewire.beneficiaire.groupements.groupement-add',
	   ['groupements'=>$this->groupements,'groupement'=>$this->ungroupement]);
}

public function resetGroupement() {
	 $this->nom_groupe  = '';
	 $this->site_id  = '';
	 $this->statut  = '';
}

}
