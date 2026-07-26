<?php
namespace App\Livewire\Geolocalisation\Zones;
use Livewire\Component;
use \App\Traits\ZoneTrait;
use \App\Models\Zone;
use Livewire\WithPagination;
class ZoneListe extends Component {
use ZoneTrait;
use WithPagination;

       protected $paginationTheme = 'bootstrap';protected $listeners = ['unzoneUpdate' => 'refresh'];
public function refresh(){
    $this->zones = \App\Models\Zone::orderBy('code','asc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\Zone::query();
	if($this->search!==null) 
	$qr=\App\Models\Zone::where('nom_zone',$this->search);
	$this->zones=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unzone=\App\Models\Zone::find($this->sid);
	return view('livewire.geolocalisation.zones.zone-liste',
	   ['zones'=>$this->zones,'zone'=>$this->unzone]);
}

public function resetZone() {
	 $this->nom_zone  = '';
	 $this->localite_id  = '';
	 $this->longitude  = '';
	 $this->lattitude  = '';
}
}