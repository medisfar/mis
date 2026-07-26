<?php
namespace App\Traits;
use Livewire\Component;
use \App\Models\Album;
Trait AlbumTrait {
  protected $albums,$unalbum;
  public  $sid,$state='home',$search;
  public $projet_id,$titre,$date_photos;

public function resetAlbum() {
	 $this->projet_id  = '';
	 $this->titre  = '';
	 $this->date_photos  = '';
}

public function cancelAlbum() {
	 $this->state       = 'home';
}

public function createAlbum() {
	 $this->state       = 'create';
 	$this->sid = null;
	$this->unalbum = new Album;
}

public function storeAlbum() {
	$this->validate([
 	'projet_id'    => 'required', 
 	'titre'    => 'required', 
 	'date_photos'    => 'required', 
	]);
	$unalbum = new Album;
	$unalbum->create([
 	'projet_id'    => $this->projet_id, 
 	'titre'    => $this->titre, 
 	'date_photos'    => $this->date_photos, 
	]);
	$this->resetAlbum();
	 $this->dispatch('albumUpdate');
	 $this->dispatch('hide-modal');
}

public function showAlbum($id) {
	 $this->state       = 'show';
 	$this->sid = $id;
	$this->unalbum =  Album::find($id);
 	$this->projet_id    = $this->unalbum->projet_id; 
 	$this->titre    = $this->unalbum->titre; 
 	$this->date_photos    = $this->unalbum->date_photos; 
}

public function editAlbum($id) {
	 $this->state       = 'edit';
 	$this->sid = $id;
	$this->unalbum =  Album::find($id);
if($this->unalbum != null) {
 	$this->projet_id    = $this->unalbum->projet_id; 
 	$this->titre    = $this->unalbum->titre; 
 	$this->date_photos    = $this->unalbum->date_photos; 
}}

public function updateAlbum() {
	$this->validate([
 	'projet_id'    => 'required', 
 	'titre'    => 'required', 
 	'date_photos'    => 'required', 
	]);
	if ($this->sid) {
   $unalbum = Album::find($this->sid);
	$unalbum->update([
 	'projet_id'    => $this->projet_id, 
 	'titre'    => $this->titre, 
 	'date_photos'    => $this->date_photos, 
	]);
	$this->resetAlbum();
	  $this->dispatch('albumUpdate');
	 $this->dispatch('hide-modal');

}}

public function destroyAlbum($id)
{
    //dd($id);
 if ($id) {
  	   $unalbum = Album::find( $id);
   	 $unalbum->delete();
	}

 $this->dispatch('albumUpdate');
	 $this->dispatch('hide-modal');

}

}
