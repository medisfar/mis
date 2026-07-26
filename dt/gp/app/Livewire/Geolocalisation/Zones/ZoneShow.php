<?php
namespace App\Livewire\Geolocalisation\Zones;
use Livewire\Component;
use \App\Traits\ZoneTrait;
use \App\Models\Zone;
class ZoneShow extends Component {
use ZoneTrait;
public function mount($id) {
	$this->sid=$id;
	$this->editZone($this->sid);}
public function render() {
	$qr=\App\Models\Zone::query();
	$this->zones=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unzone=\App\Models\Zone::find($this->sid);
	return view('livewire.geolocalisation.zones.zone-show',
	   ['zones'=>$this->zones,'zone'=>$this->unzone]);
}

public function resetZone() {
	 $this->nom_zone  = '';
	 $this->localite_id  = '';
	 $this->longitude  = '';
	 $this->lattitude  = '';
}
}