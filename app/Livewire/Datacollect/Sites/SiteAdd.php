<?php
namespace App\Livewire\Datacollect\Sites;
use Livewire\Component;
use \App\Traits\SiteTrait;
use \App\Models\Site;
class SiteAdd extends Component {
use SiteTrait;
public $listeners = ['valueUpdated'=>'updateValue'];

  public function updateValue($value){
       
        $this->localite_id=$value;
    }

public function render() {
	$qr=\App\Models\Site::query();
	$this->sites=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unsite=\App\Models\Site::find($this->sid);
	$this->createSite($this->sid);	return view('livewire.datacollect.sites.site-add',
	   ['sites'=>$this->sites,'site'=>$this->unsite]);
}

public function resetSite() {
	 $this->nom  = '';
	 $this->type_point_focal  = '';
	 $this->nom_point_focal  = '';
	 $this->localite_id  = '';
}
}