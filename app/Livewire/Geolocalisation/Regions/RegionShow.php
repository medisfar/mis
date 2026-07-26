<?php
namespace App\Livewire\Geolocalisation\Regions;
use Livewire\Component;
use \App\Traits\RegionTrait;
use \App\Models\Region;
class RegionShow extends Component {
use RegionTrait;
public function mount($id) {
	$this->sid=$id;
	$this->editRegion($this->sid);}
public function render() {
	$qr=\App\Models\Region::query();
	$this->regions=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unregion=\App\Models\Region::find($this->sid);
	return view('livewire.geolocalisation.regions.region-show',
	   ['regions'=>$this->regions,'region'=>$this->unregion]);
}

public function resetRegion() {
	 $this->code  = '';
	 $this->nom_region  = '';
}
}