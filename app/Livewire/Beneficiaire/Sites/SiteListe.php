<?php
namespace App\Livewire\Beneficiaire\Sites;
use Livewire\Component;
use \App\Traits\SiteTrait;
use \App\Models\Site;
use Livewire\WithPagination;
class SiteListe extends Component {
use SiteTrait;
use WithPagination;

       protected $paginationTheme = 'bootstrap';protected $listeners = ['unsiteUpdate' => 'refresh'];
public function refresh(){
    $this->sites = \App\Models\Site::orderBy('code','asc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\Site::query();
	if($this->search!==null) 
	$qr=\App\Models\Site::where('nom',$this->search);
	$this->sites=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unsite=\App\Models\Site::find($this->sid);
	return view('livewire.beneficiaire.sites.site-liste',
	   ['sites'=>$this->sites,'site'=>$this->unsite]);
}

public function resetSite() {
	 $this->nom  = '';
	 $this->activite_id  = '';
}
}