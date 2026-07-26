<?php
namespace App\Traits;
use Livewire\Component;
use \App\Models\Prefecture;
Trait PrefectureTrait {
  protected $prefectures,$unprefecture;
  public  $sid,$state='home',$search;
  public $region_id,$code,$nom_prefecture,$l_type;

public function resetPrefecture() {
	 $this->region_id  = '';
	 $this->code  = '';
	 $this->nom_prefecture  = '';
	 $this->l_type  = '';
}

public function cancelPrefecture() {
	 $this->state       = 'home';
}

public function createPrefecture() {
	 $this->state       = 'create';
 	$this->sid = null;
	$this->unprefecture = new Prefecture;
}

public function storePrefecture() {
	$this->validate([
 	'region_id'    => 'required', 
 	'code'    => 'required', 
 	'nom_prefecture'    => 'required', 
 	'l_type'    => 'required', 
	]);
	$unprefecture = new Prefecture;
	$unprefecture->create([
 	'region_id'    => $this->region_id, 
 	'code'    => $this->code, 
 	'nom_prefecture'    => $this->nom_prefecture, 
 	'l_type'    => $this->l_type, 
	]);
	$this->resetPrefecture();
	$this->dispatch('prefectureUpdate');
    $this->dispatch('hide-modal');
}


public function showPrefecture($id) {
	 $this->state       = 'show';
 	$this->sid = $id;
	$this->unprefecture =  Prefecture::find($id);
 	$this->region_id    = $this->unprefecture->region_id; 
 	$this->code    = $this->unprefecture->code; 
 	$this->nom_prefecture    = $this->unprefecture->nom_prefecture; 
 	$this->l_type    = $this->unprefecture->l_type; 
}

public function editPrefecture($id) {
	 $this->state       = 'edit';
 	$this->sid = $id;
	$this->unprefecture =  Prefecture::find($id);
if($this->unprefecture != null) {
 	$this->region_id    = $this->unprefecture->region_id; 
 	$this->code    = $this->unprefecture->code; 
 	$this->nom_prefecture    = $this->unprefecture->nom_prefecture; 
 	$this->l_type    = $this->unprefecture->l_type; 
}}

public function updatePrefecture() {
	$this->validate([
 	'region_id'    => 'required', 
 	'code'    => 'required', 
 	'nom_prefecture'    => 'required', 
 	'l_type'    => 'required', 
	]);
	if ($this->sid) {
   $unprefecture = Prefecture::find($this->sid);
	$unprefecture->update([
 	'region_id'    => $this->region_id, 
 	'code'    => $this->code, 
 	'nom_prefecture'    => $this->nom_prefecture, 
 	'l_type'    => $this->l_type, 
	]);
	$this->resetPrefecture();
	$this->dispatch('prefectureUpdate');
    $this->dispatch('hide-modal');

}}

public function destroyPrefecture($id)
{
 if ($id) {
  	   $unprefecture = Prefecture::find( $id);
   	 $unprefecture->delete();
	}

	$this->dispatch('prefectureUpdate');
    $this->dispatch('hide-modal');
	
}

}
