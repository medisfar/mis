<?php
namespace App\Livewire\Geolocalisation\Prefectures;
use Livewire\Component;
use \App\Traits\PrefectureTrait;
use \App\Models\Prefecture;
class PrefectureEdit extends Component {
use PrefectureTrait;
public function mount($id) {
	$this->sid=$id;
	$this->editPrefecture($this->sid);}
public function render() {
	$qr=\App\Models\Prefecture::query();
	$this->prefectures=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unprefecture=\App\Models\Prefecture::find($this->sid);
	return view('livewire.geolocalisation.prefectures.prefecture-edit',
	   ['prefectures'=>$this->prefectures,'prefecture'=>$this->unprefecture]);
}

public function resetPrefecture() {
	 $this->region_id  = '';
	 $this->code  = '';
	 $this->nom_prefecture  = '';
	 $this->l_type  = '';
}
}