<?php
namespace App\Livewire\Projet\Missions;
use Livewire\Component;
use \App\Traits\MissionTrait;
use \App\Models\Mission;
use Livewire\WithPagination;
class MissionListe extends Component {
use MissionTrait;
use WithPagination;

       protected $paginationTheme = 'bootstrap';protected $listeners = ['unmissionUpdate' => 'refresh'];
public function refresh(){
    $this->missions = \App\Models\Mission::orderBy('code','asc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\Mission::query();
	if($this->search!==null) 
	$qr=\App\Models\Mission::where('libelle',$this->search);
	$this->missions=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unmission=\App\Models\Mission::find($this->sid);
	return view('livewire.projet.missions.mission-liste',
	   ['missions'=>$this->missions,'mission'=>$this->unmission]);
}

public function resetMission() {
	 $this->libelle  = '';
	 $this->description  = '';
}
}