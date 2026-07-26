<?php
namespace App\Livewire\Projet\Albums;
use Livewire\Component;
use \App\Traits\AlbumTrait;
use \App\Models\Album;
class AlbumAdd extends Component {
use AlbumTrait;
protected $listeners = ['unalbumUpdate' => 'refresh'];
public function refresh(){
    $this->albums = \App\Models\Album::orderBy('code','asc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\Album::query();
	$this->albums=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unalbum=\App\Models\Album::find($this->sid);
	$this->createAlbum($this->sid);	return view('livewire.projet.albums.album-add',
	   ['albums'=>$this->albums,'album'=>$this->unalbum]);
}

public function resetAlbum() {
	 $this->projet_id  = '';
	 $this->titre  = '';
	 $this->date_photos  = '';
}
}