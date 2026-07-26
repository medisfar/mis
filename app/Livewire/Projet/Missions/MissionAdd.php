<?php
namespace App\Livewire\Projet\Missions;
use Livewire\Component;
use \App\Traits\MissionTrait;
use \App\Models\Mission;
class MissionAdd extends Component {
use MissionTrait;
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
	$this->createMission($this->sid);	return view('livewire.projet.missions.mission-add',
	   ['missions'=>$this->missions,'mission'=>$this->unmission]);
}

public function resetMission() {
	 $this->libelle  = '';
	 $this->description  = '';
}
}