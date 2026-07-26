<?php
namespace App\Livewire\Datacollect\Menages;
use Livewire\Component;
use \App\Traits\MenageTrait;
use \App\Models\Menage;
class MenageShow extends Component {
use MenageTrait;

public function mount($id) {
	$this->sid=$id;
	
	$this->editMenage($this->sid);}
protected $listeners = ['ShowUpdate' => 'refresh'];
public function refresh(){
    $this->unmenage=\App\Models\Menage::find($this->sid);
    $this->render();
}
public function render() {
	$qr=\App\Models\Menage::query();
	$this->menages=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unmenage=\App\Models\Menage::find($this->sid);
	return view('livewire.datacollect.menages.menage-show',
	   ['menages'=>$this->menages,'menage'=>$this->unmenage]);
}

public function resetMenage() {
	 $this->localite_id  = '';
	 $this->toit_id  = '';
	 $this->chef  = '';
	 $this->conjoint  = '';
	 $this->tel1  = '';
	 $this->tel2  = '';
}
}