<?php
namespace App\Livewire\Geolocalisation\Ssprefectures;
use Livewire\Component;
use \App\Traits\SsrefectureTrait;
use \App\Models\Ssrefecture;
class SsrefectureEdit extends Component {
use SsrefectureTrait;
public function mount($id) {
	$this->sid=$id;
	$this->editSsrefecture($this->sid);}
public function render() {
	$qr=\App\Models\Ssrefecture::query();
	$this->ssprefectures=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unssrefecture=\App\Models\Ssrefecture::find($this->sid);
	return view('livewire.geolocalisation.ssprefectures.ssrefecture-edit',
	   ['ssprefectures'=>$this->ssprefectures,'ssrefecture'=>$this->unssrefecture]);
}

public function resetSsrefecture() {
	 $this->prefecture_id  = '';
	 $this->code  = '';
	 $this->nom_ssprefecture  = '';
	 $this->l_type  = '';
}
}