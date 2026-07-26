<?php
namespace App\Livewire\Geolocalisation\Localites;
use Livewire\Component;
use \App\Traits\LocaliteTrait;
use \App\Models\Localite;
use Livewire\WithPagination;
class LocaliteListe extends Component {
use LocaliteTrait;
use WithPagination;

       protected $paginationTheme = 'bootstrap';public function render() {
	$qr=\App\Models\Localite::query();
	if($this->search!==null) 
	$qr=\App\Models\Localite::where('nom_localite',$this->search);
	$this->localites=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unlocalite=\App\Models\Localite::find($this->sid);
	return view('livewire.geolocalisation.localites.localite-liste',
	   ['localites'=>$this->localites,'localite'=>$this->unlocalite]);
}

public function resetLocalite() {
	 $this->nom_localite  = '';
	 $this->ssprefecture_id  = '';
	 $this->l_type  = '';
}
}