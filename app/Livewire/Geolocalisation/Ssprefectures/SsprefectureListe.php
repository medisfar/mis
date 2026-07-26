<?php
namespace App\Livewire\Geolocalisation\Ssprefectures;
use Livewire\Component;
use \App\Traits\SsprefectureTrait;
use \App\Models\Ssprefecture;
use Livewire\WithPagination;
class SsprefectureListe extends Component {
use SsprefectureTrait;
use WithPagination;

     protected $listeners = ['ssprefectureUpdate' => 'refresh'];

public function refresh(){
  
    $this->regions=\App\Models\Ssprefecture::orderBy('code','asc')->paginate(20);
   
}  protected $paginationTheme = 'bootstrap';public function render() {
	$qr=\App\Models\Ssprefecture::query();
	if($this->search!==null) 
	$qr=\App\Models\Ssprefecture::where('prefecture_id',$this->search);
	$this->ssprefectures=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unssprefecture=\App\Models\Ssprefecture::find($this->sid);
	return view('livewire.geolocalisation.ssprefectures.ssprefecture-liste',
	   ['ssprefectures'=>$this->ssprefectures,'ssprefecture'=>$this->unssprefecture]);
}

public function resetSsprefecture() {
	 $this->prefecture_id  = '';
	 $this->code  = '';
	 $this->nom_ssprefecture  = '';
	 $this->l_type  = '';
}
}