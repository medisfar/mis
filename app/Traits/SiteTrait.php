<?php
namespace App\Traits;
use Livewire\Component;
use \App\Models\Site;
Trait SiteTrait {
  protected $sites,$unsite;
  public  $sid,$state='home',$search;
  public $nom,$type_point_focal,$nom_point_focal,$localite_id,$lattitude,$longitude;

public function resetSite() {
	 $this->nom  = '';
	 $this->type_point_focal  = '';
	 $this->nom_point_focal  = '';
	 $this->localite_id  = '';
	 $this->lattitude  = '';
	 $this->longitude  = '';
}

public function cancelSite() {
	 $this->state       = 'home';
}

public function createSite() {
	 $this->state       = 'create';
 	$this->sid = null;
	$this->unsite = new Site;
}

public function storeSite() {
	$this->validate([
 	'nom'    => 'required', 
 	'type_point_focal'    => 'required', 
 	'nom_point_focal'    => 'required', 
 	'localite_id'    => 'required', 
 	'lattitude'    => 'required', 
 	'longitude'    => 'required', 
	]);
	$unsite = new Site;
	$unsite->create([
 	'nom'    => $this->nom, 
 	'type_point_focal'    => $this->type_point_focal, 
 	'nom_point_focal'    => $this->nom_point_focal, 
 	'localite_id'    => $this->localite_id, 
 	'lattitude'    => $this->lattitude, 
 	'longitude'    => $this->longitude, 
	]);
	$this->resetSite();
	 return redirect()->route('projet.sites');
}

public function showSite($id) {
	 $this->state       = 'show';
 	$this->sid = $id;
	$this->unsite =  Site::find($id);
 	$this->nom    = $this->unsite->nom; 
 	$this->type_point_focal    = $this->unsite->type_point_focal; 
 	$this->nom_point_focal    = $this->unsite->nom_point_focal; 
 	$this->localite_id    = $this->unsite->localite_id; 
 	$this->lattitude    = $this->unsite->lattitude; 
 	$this->longitude    = $this->unsite->longitude; 
}

public function editSite($id) {
	 $this->state       = 'edit';
 	$this->sid = $id;
	$this->unsite =  Site::find($id);
if($this->unsite != null) {
 	$this->nom    = $this->unsite->nom; 
 	$this->type_point_focal    = $this->unsite->type_point_focal; 
 	$this->nom_point_focal    = $this->unsite->nom_point_focal; 
 	$this->localite_id    = $this->unsite->localite_id; 
 	$this->lattitude    = $this->unsite->lattitude; 
 	$this->longitude    = $this->unsite->longitude; 
}}

public function updateSite() {
	$this->validate([
 	'nom'    => 'required', 
 	'type_point_focal'    => 'required', 
 	'nom_point_focal'    => 'required', 
 	'localite_id'    => 'required', 
 	'lattitude'    => 'required', 
 	'longitude'    => 'required', 
	]);
	if ($this->sid) {
   $unsite = Site::find($this->sid);
	$unsite->update([
 	'nom'    => $this->nom, 
 	'type_point_focal'    => $this->type_point_focal, 
 	'nom_point_focal'    => $this->nom_point_focal, 
 	'localite_id'    => $this->localite_id, 
 	'lattitude'    => $this->lattitude, 
 	'longitude'    => $this->longitude, 
	]);
	$this->resetSite();
	 return redirect()->route('projet.sites');

}}

public function destroySite($id)
{
 if ($id) {
  	   $unsite = Site::find( $id);
   	 $unsite->delete();
	}


	 return redirect()->route('projet.sites');
}

}
