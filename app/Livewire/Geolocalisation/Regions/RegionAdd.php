<?php
namespace App\Livewire\Geolocalisation\Regions;
use Livewire\Component;
use \App\Traits\RegionTrait;
use \App\Models\Region;
class RegionAdd extends Component {
use RegionTrait;


public function render() {
	$qr=\App\Models\Region::query();
	$this->regions=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unregion=\App\Models\Region::find($this->sid);
	$this->createRegion($this->sid);	return view('livewire.geolocalisation.regions.region-add',
	   ['regions'=>$this->regions,'region'=>$this->unregion]);
}

public function resetRegion() {
	 $this->code  = '';
	 $this->nom_region  = '';
}
}