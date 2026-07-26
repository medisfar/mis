<?php
namespace App\Livewire\Geolocalisation\Ssprefectures;
use Livewire\Component;
use \App\Traits\SsrefectureTrait;
use \App\Models\Ssrefecture;
use Livewire\WithPagination;
class SsrefectureListe extends Component {
use SsrefectureTrait;
use WithPagination;

       protected $paginationTheme = 'bootstrap';public function render() {
	$qr=\App\Models\Ssrefecture::query();
	if($this->search!==null) 
	$qr=\App\Models\Ssrefecture::where('prefecture_id',$this->search);
	$this->ssprefectures=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unssrefecture=\App\Models\Ssrefecture::find($this->sid);
	return view('livewire.geolocalisation.ssprefectures.ssrefecture-liste',
	   ['ssprefectures'=>$this->ssprefectures,'ssrefecture'=>$this->unssrefecture]);
}

public function resetSsrefecture() {
	 $this->prefecture_id  = '';
	 $this->code  = '';
	 $this->nom_ssprefecture  = '';
	 $this->l_type  = '';
}
}