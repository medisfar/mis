<?php
namespace App\Traits;
use Livewire\Component;
use \App\Models\Ssprefecture;
Trait SsprefectureTrait {
  protected $ssprefectures,$unssprefecture;
  public  $sid,$state='home',$search;
  public $prefecture_id,$code,$nom_ssprefecture,$l_type;

public function resetSsprefecture() {
	 $this->prefecture_id  = '';
	 $this->code  = '';
	 $this->nom_ssprefecture  = '';
	 $this->l_type  = '';
}

public function cancelSsprefecture() {
	 $this->state       = 'home';
}

public function createSsprefecture() {
	 $this->state       = 'create';
 	$this->sid = null;
	$this->unssprefecture = new Ssprefecture;
}

public function storeSsprefecture() {
	$this->validate([
 	'prefecture_id'    => 'required', 
 	'code'    => 'required', 
 	'nom_ssprefecture'    => 'required', 
 	'l_type'    => 'required', 
	]);
	$unssprefecture = new Ssprefecture;
	$unssprefecture->create([
 	'prefecture_id'    => $this->prefecture_id, 
 	'code'    => $this->code, 
 	'nom_ssprefecture'    => $this->nom_ssprefecture, 
 	'l_type'    => $this->l_type, 
	]);
	$this->resetSsprefecture();
	 return redirect()->route('geolocalisation.ssprefectures');
}

public function showSsprefecture($id) {
	 $this->state       = 'show';
 	$this->sid = $id;
	$this->unssprefecture =  Ssprefecture::find($id);
 	$this->prefecture_id    = $this->unssprefecture->prefecture_id; 
 	$this->code    = $this->unssprefecture->code; 
 	$this->nom_ssprefecture    = $this->unssprefecture->nom_ssprefecture; 
 	$this->l_type    = $this->unssprefecture->l_type; 
}

public function editSsprefecture($id) {
	 $this->state       = 'edit';
 	$this->sid = $id;
	$this->unssprefecture =  Ssprefecture::find($id);
if($this->unssprefecture != null) {
 	$this->prefecture_id    = $this->unssprefecture->prefecture_id; 
 	$this->code    = $this->unssprefecture->code; 
 	$this->nom_ssprefecture    = $this->unssprefecture->nom_ssprefecture; 
 	$this->l_type    = $this->unssprefecture->l_type; 
}}

public function updateSsprefecture() {
	$this->validate([
 	'prefecture_id'    => 'required', 
 	'code'    => 'required', 
 	'nom_ssprefecture'    => 'required', 
 	'l_type'    => 'required', 
	]);
	if ($this->sid) {
   $unssprefecture = Ssprefecture::find($this->sid);
	$unssprefecture->update([
 	'prefecture_id'    => $this->prefecture_id, 
 	'code'    => $this->code, 
 	'nom_ssprefecture'    => $this->nom_ssprefecture, 
 	'l_type'    => $this->l_type, 
	]);
	$this->resetSsprefecture();
	 return redirect()->route('geolocalisation.ssprefectures');

}}

public function destroySsprefecture($id)
{
 if ($id) {
  	   $unssprefecture = Ssprefecture::find( $id);
   	 $unssprefecture->delete();
	}


	 return redirect()->route('geolocalisation.ssprefectures');
}

}
