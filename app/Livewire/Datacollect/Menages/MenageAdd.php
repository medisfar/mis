<?php
namespace App\Livewire\Datacollect\Menages;
use Livewire\Component;
use \App\Traits\MenageTrait;
use \App\Models\Menage;
class MenageAdd extends Component {
use MenageTrait;
protected $listeners = ['unmenageUpdate' => 'refresh','valueUpdated'=>'updateValue'];


  public function updateValue($value){
       
        $this->localite_id=$value;
    }
public function refresh(){
    $this->menages = \App\Models\Menage::orderBy('code','asc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\Menage::query();
	$this->menages=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unmenage=\App\Models\Menage::find($this->sid);
	$this->createMenage($this->sid);	return view('livewire.datacollect.menages.menage-add',
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
public function remplir(){
	$this->localite_id    = 44;
 //	$this->toit_id    = $this->unmenage->toit_id; 
 	$this->chef    = \App\Uts::gennom('M'); 
 	$this->conjoint    = \App\Uts::gennom('F'); 
 	$this->tel1    = '77'.rand(1000,9999);
 	$this->tel2    = '77'.rand(1000,9999); 
}
}