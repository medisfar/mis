<?php
namespace App\Livewire\Datacollect\Menages;
use Livewire\Component;
use \App\Traits\MenageTrait;
use \App\Models\Menage;
use Livewire\WithPagination;
class MenageListe extends Component {
use MenageTrait;
use WithPagination;

       protected $paginationTheme = 'bootstrap';protected $listeners = ['unmenageUpdate' => 'refresh'];
public function refresh(){
    $this->menages = \App\Models\Menage::orderBy('id','desc')->paginate(10);
    $this->render();
}
public function render() {
	$qr=\App\Models\Menage::query();
	if($this->search!==null) 
	$qr=\App\Models\Menage::where('chef','like',$this->search.'%');
	$this->menages=$qr->orderBy('id','desc')->paginate(20);
	if($this->sid!==null) 
	$this->unmenage=\App\Models\Menage::find($this->sid);
	return view('livewire.datacollect.menages.menage-liste',
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