<?php
namespace App\Livewire\Monitoring\Missions;
use Livewire\Component;
use \App\Traits\MissionTrait;
use \App\Models\Mission;
class MissionAdd extends Component {
use MissionTrait;
public function render() {
	$qr=\App\Models\Mission::query();
	$this->missions=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unmission=\App\Models\Mission::find($this->sid);
	$this->createMission($this->sid);	return view('livewire.monitoring.missions.mission-add',
	   ['missions'=>$this->missions,'mission'=>$this->unmission]);
}

public function resetMission() {
	 $this->libelle  = '';
	 $this->description  = '';
}
}