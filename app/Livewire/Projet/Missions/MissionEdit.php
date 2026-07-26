<?php
namespace App\Livewire\Projet\Missions;
use Livewire\Component;
use \App\Traits\MissionTrait;
use \App\Models\Mission;
class MissionEdit extends Component {
use MissionTrait;
public function mount($id) {
	$this->sid=$id;
	$this->editMission($this->sid);}
protected $listeners = ['unmissionUpdate' => 'refresh'];
public function refresh(){
    $this->missions = \App\Models\Mission::orderBy('code','asc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\Mission::query();
	$this->missions=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unmission=\App\Models\Mission::find($this->sid);
	return view('livewire.projet.missions.mission-edit',
	   ['missions'=>$this->missions,'mission'=>$this->unmission]);
}

public function resetMission() {
	 $this->libelle  = '';
	 $this->description  = '';
}
}