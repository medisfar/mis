<?php
namespace App\Livewire\Beneficiaire\Menages;
use Livewire\Component;
use \App\Traits\MenageTrait;
use \App\Models\Menage;
class MenageAdd extends Component {
use MenageTrait;
public function render() {
	$qr=\App\Models\Menage::query();
	$this->menages=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unmenage=\App\Models\Menage::find($this->sid);
	$this->createMenage($this->sid);	return view('livewire.beneficiaire.menages.menage-add',
	   ['menages'=>$this->menages,'menage'=>$this->unmenage]);
}

public function resetMenage() {
	 $this->toit_id  = '';
	 $this->chef  = '';
}
}