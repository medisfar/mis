<?php
namespace App\Livewire\Datacollect\Menages;
use Livewire\Component;
use \App\Traits\MenageTrait;
use \App\Models\Menage;
class MenageEdit extends Component {
use MenageTrait;
public function mount($id) {
	$this->sid=$id;
	$this->editMenage($this->sid);}
protected $listeners = ['unmenageUpdate' => 'refresh'];
public function refresh(){
    $this->menages = \App\Models\Menage::orderBy('code','asc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\Menage::query();
	$this->menages=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unmenage=\App\Models\Menage::find($this->sid);
	return view('livewire.datacollect.menages.menage-edit',
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