<?php
namespace App\Traits;
use Livewire\Component;
use \App\Models\Ssrefecture;
Trait SsrefectureTrait {
  protected $ssprefectures,$unssrefecture;
  public  $sid,$state='home',$search;
  public $prefecture_id,$code,$nom_ssprefecture,$l_type;

public function resetSsrefecture() {
	 $this->prefecture_id  = '';
	 $this->code  = '';
	 $this->nom_ssprefecture  = '';
	 $this->l_type  = '';
}

public function cancelSsrefecture() {
	 $this->state       = 'home';
}

public function createSsrefecture() {
	 $this->state       = 'create';
 	$this->sid = null;
	$this->unssrefecture = new Ssrefecture;
}

public function storeSsrefecture() {
	$this->validate([
 	'prefecture_id'    => 'required', 
 	'code'    => 'required', 
 	'nom_ssprefecture'    => 'required', 
 	'l_type'    => 'required', 
	]);
	$unssrefecture = new Ssrefecture;
	$unssrefecture->create([
 	'prefecture_id'    => $this->prefecture_id, 
 	'code'    => $this->code, 
 	'nom_ssprefecture'    => $this->nom_ssprefecture, 
 	'l_type'    => $this->l_type, 
	]);
	$this->resetSsrefecture();
	 return redirect()->route('geolocalisation.ssprefectures');
}

public function showSsrefecture($id) {
	 $this->state       = 'show';
 	$this->sid = $id;
	$this->unssrefecture =  Ssrefecture::find($id);
 	$this->prefecture_id    = $this->unssrefecture->prefecture_id; 
 	$this->code    = $this->unssrefecture->code; 
 	$this->nom_ssprefecture    = $this->unssrefecture->nom_ssprefecture; 
 	$this->l_type    = $this->unssrefecture->l_type; 
}

public function editSsrefecture($id) {
	 $this->state       = 'edit';
 	$this->sid = $id;
	$this->unssrefecture =  Ssrefecture::find($id);
if($this->unssrefecture != null) {
 	$this->prefecture_id    = $this->unssrefecture->prefecture_id; 
 	$this->code    = $this->unssrefecture->code; 
 	$this->nom_ssprefecture    = $this->unssrefecture->nom_ssprefecture; 
 	$this->l_type    = $this->unssrefecture->l_type; 
}}

public function updateSsrefecture() {
	$this->validate([
 	'prefecture_id'    => 'required', 
 	'code'    => 'required', 
 	'nom_ssprefecture'    => 'required', 
 	'l_type'    => 'required', 
	]);
	if ($this->sid) {
   $unssrefecture = Ssrefecture::find($this->sid);
	$unssrefecture->update([
 	'prefecture_id'    => $this->prefecture_id, 
 	'code'    => $this->code, 
 	'nom_ssprefecture'    => $this->nom_ssprefecture, 
 	'l_type'    => $this->l_type, 
	]);
	$this->resetSsrefecture();
	 return redirect()->route('geolocalisation.ssprefectures');

}}

public function destroySsrefecture($id)
{
 if ($id) {
  	   $unssrefecture = Ssrefecture::find( $id);
   	 $unssrefecture->delete();
	}


	 return redirect()->route('geolocalisation.ssprefectures');
}

}
