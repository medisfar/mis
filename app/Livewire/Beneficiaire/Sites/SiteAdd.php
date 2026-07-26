<?php
namespace App\Livewire\Beneficiaire\Sites;
use Livewire\Component;
use \App\Traits\SiteTrait;
use \App\Models\Site;
class SiteAdd extends Component {
use SiteTrait;
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
	$this->createSite($this->sid);	return view('livewire.beneficiaire.sites.site-add',
	   ['sites'=>$this->sites,'site'=>$this->unsite]);
}

public function resetSite() {
	 $this->nom  = '';
	 $this->activite_id  = '';
}
}