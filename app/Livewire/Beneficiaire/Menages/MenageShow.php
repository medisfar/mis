<?php
namespace App\Livewire\Beneficiaire\Menages;
use Livewire\Component;
use \App\Traits\MenageTrait;
use \App\Models\Menage;
class MenageShow extends Component {
use MenageTrait;
public function mount($id) {
	$this->sid=$id;
	$this->editMenage($this->sid);}
public function render() {
	$qr=\App\Models\Menage::query();
	$this->menages=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unmenage=\App\Models\Menage::find($this->sid);
	return view('livewire.beneficiaire.menages.menage-show',
	   ['menages'=>$this->menages,'menage'=>$this->unmenage]);
}

public function resetMenage() {
	 $this->toit_id  = '';
	 $this->chef  = '';
}
}