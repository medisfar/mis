<?php
namespace App\Livewire\Geolocalisation\Regions;
use Livewire\Component;
use \App\Traits\RegionTrait;
use \App\Models\Region;
use Livewire\WithPagination;
class RegionListe extends Component {
use RegionTrait;
use WithPagination;

       protected $paginationTheme = 'bootstrap';public function render() {
	$qr=\App\Models\Region::query();
	if($this->search!==null) 
	$qr=\App\Models\Region::where('code',$this->search);
	$this->regions=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unregion=\App\Models\Region::find($this->sid);
	return view('livewire.geolocalisation.regions.region-liste',
	   ['regions'=>$this->regions,'region'=>$this->unregion]);
}

public function resetRegion() {
	 $this->code  = '';
	 $this->nom_region  = '';
}
}