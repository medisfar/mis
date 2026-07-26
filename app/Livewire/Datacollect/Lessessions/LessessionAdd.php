<?php
namespace App\Livewire\Datacollect\Lessessions;
use Livewire\Component;
use \App\Traits\LessessionTrait;
use \App\Models\Lessession;
class LessessionAdd extends Component {
use LessessionTrait;
public $localite_id,$site_id;
protected $listeners = ['unlessessionUpdate' => 'refresh'];
public function refresh(){
    $this->lessessions = \App\Models\Lessession::orderBy('code','asc')->paginate(20);
    $this->render();
}
public function render() {
    $locs=[];
	$projet=\App\Models\Projet::find(session()->get('pid',11));
	foreach($projet->sites as $s)
	  $locs[$s->localite->id]=$s->localite->nom_localite;
	$qr=\App\Models\Lessession::query();
	$this->lessessions=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unlessession=\App\Models\Lessession::find($this->sid);
	$this->createLessession($this->sid);	return view('livewire.datacollect.lessessions.lessession-add',
	   ['lessessions'=>$this->lessessions,'lessession'=>$this->unlessession,'locs'=>$locs]);
}

public function resetLessession() {
	 $this->nom  = '';
	 $this->site_id  = '';
	 $this->date_session  = '';
	 $this->groupement_id  = '';
}
}