<?php
namespace App\Livewire\Beneficiaire\Menages;
use Livewire\Component;
use \App\Traits\MenageTrait;
use \App\Models\Menage;
use Livewire\WithPagination;
class MenageListe extends Component {
use MenageTrait;
use WithPagination;

       protected $paginationTheme = 'bootstrap';public function render() {
	$qr=\App\Models\Menage::query();
	if($this->search!==null) 
	$qr=\App\Models\Menage::where('chef',$this->search.'%');
	$this->menages=$qr->orderBy('id','desc')->paginate(10);
	if($this->sid!==null) 
	$this->unmenage=\App\Models\Menage::find($this->sid);
	return view('livewire.beneficiaire.menages.menage-liste',
	   ['menages'=>$this->menages,'menage'=>$this->unmenage]);
}

public function resetMenage() {
	 $this->toit_id  = '';
	 $this->chef  = '';
}
}