<?php
namespace App\Livewire\Geolocalisation\Prefectures;
use Livewire\Component;
use \App\Traits\PrefectureTrait;
use \App\Models\Prefecture;
class PrefectureAdd extends Component {
use PrefectureTrait;
public function render() {
	$qr=\App\Models\Prefecture::query();
	$this->prefectures=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unprefecture=\App\Models\Prefecture::find($this->sid);
	$this->createPrefecture($this->sid);	return view('livewire.geolocalisation.prefectures.prefecture-add',
	   ['prefectures'=>$this->prefectures,'prefecture'=>$this->unprefecture]);
}

public function resetPrefecture() {
	 $this->region_id  = '';
	 $this->code  = '';
	 $this->nom_prefecture  = '';
	 $this->l_type  = '';
}
}