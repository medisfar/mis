<?php
namespace App\Livewire\Geolocalisation\Zones;
use Livewire\Component;
use \App\Traits\ZoneTrait;
use \App\Models\Zone;
class ZoneEdit extends Component {
use ZoneTrait;
public function mount($id) {
	$this->sid=$id;
	$this->editZone($this->sid);}
protected $listeners = ['unzoneUpdate' => 'refresh'];
public function refresh(){
    $this->zones = \App\Models\Zone::orderBy('code','asc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\Zone::query();
	$this->zones=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unzone=\App\Models\Zone::find($this->sid);
	return view('livewire.geolocalisation.zones.zone-edit',
	   ['zones'=>$this->zones,'zone'=>$this->unzone]);
}

public function resetZone() {
	 $this->nom_zone  = '';
	 $this->localite_id  = '';
	 $this->longitude  = '';
	 $this->lattitude  = '';
}
}