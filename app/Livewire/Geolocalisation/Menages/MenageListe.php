<?php
namespace App\Livewire\Geolocalisation\Menages;
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
	$qr=\App\Models\Menage::where('toit_id',$this->search);
	$this->menages=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unmenage=\App\Models\Menage::find($this->sid);
	return view('livewire.geolocalisation.menages.menage-liste',
	   ['menages'=>$this->menages,'menage'=>$this->unmenage]);
}

public function resetMenage() {
	 $this->toit_id  = '';
	 $this->chef  = '';
	 $this->localite_id  = '';
}
}