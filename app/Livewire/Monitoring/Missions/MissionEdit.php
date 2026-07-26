<?php
namespace App\Livewire\Monitoring\Missions;
use Livewire\Component;
use \App\Traits\MissionTrait;
use \App\Models\Mission;
class MissionEdit extends Component {
use MissionTrait;
public function mount($id) {
	$this->sid=$id;
	$this->editMission($this->sid);}
public function render() {
	$qr=\App\Models\Mission::query();
	$this->missions=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unmission=\App\Models\Mission::find($this->sid);
	return view('livewire.monitoring.missions.mission-edit',
	   ['missions'=>$this->missions,'mission'=>$this->unmission]);
}

public function resetMission() {
	 $this->libelle  = '';
	 $this->description  = '';
}
}