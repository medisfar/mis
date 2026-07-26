<?php
namespace App\Livewire\Beneficiaire\Sites;
use Livewire\Component;
use \App\Traits\SiteTrait;
use \App\Models\Site;
class SiteShow extends Component {
use SiteTrait;
public function mount($id) {
	$this->sid=$id;
	$this->editSite($this->sid);}
protected $listeners = ['unsiteUpdate' => 'refresh'];
public function refresh(){
    $this->sites = \App\Models\Site::orderBy('code','asc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\Site::query();
	$this->sites=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unsite=\App\Models\Site::find($this->sid);
	return view('livewire.beneficiaire.sites.site-show',
	   ['sites'=>$this->sites,'site'=>$this->unsite]);
}

public function resetSite() {
	 $this->nom  = '';
	 $this->activite_id  = '';
}
}