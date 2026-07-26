<?php
namespace App\Livewire\Geolocalisation\Ssprefectures;
use Livewire\Component;
use \App\Traits\SsprefectureTrait;
use \App\Models\Ssprefecture;
class SsprefectureAdd extends Component {
use SsprefectureTrait;
public function render() {
	$qr=\App\Models\Ssprefecture::query();
	$this->ssprefectures=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unssprefecture=\App\Models\Ssprefecture::find($this->sid);
	$this->createSsprefecture($this->sid);	return view('livewire.geolocalisation.ssprefectures.ssprefecture-add',
	   ['ssprefectures'=>$this->ssprefectures,'ssprefecture'=>$this->unssprefecture]);
}

public function resetSsprefecture() {
	 $this->prefecture_id  = '';
	 $this->code  = '';
	 $this->nom_ssprefecture  = '';
	 $this->l_type  = '';
}
}