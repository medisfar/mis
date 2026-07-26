<?php
namespace App\Livewire\Geolocalisation\Localites;
use Livewire\Component;
use \App\Traits\LocaliteTrait;
use \App\Models\Localite;
class LocaliteShow extends Component {
use LocaliteTrait;
public function mount($id) {
	$this->sid=$id;
	$this->editLocalite($this->sid);}
public function render() {
	$qr=\App\Models\Localite::query();
	$this->localites=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unlocalite=\App\Models\Localite::find($this->sid);
	return view('livewire.geolocalisation.localites.localite-show',
	   ['localites'=>$this->localites,'localite'=>$this->unlocalite]);
}

public function resetLocalite() {
	 $this->nom_localite  = '';
	 $this->ssprefecture_id  = '';
	 $this->l_type  = '';
}
}