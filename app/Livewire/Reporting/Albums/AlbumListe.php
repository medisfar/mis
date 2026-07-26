<?php
namespace App\Livewire\Reporting\Albums;
use Livewire\Component;
use \App\Traits\AlbumTrait;
use \App\Models\Album;
use Livewire\WithPagination;
class AlbumListe extends Component {
use AlbumTrait;
use WithPagination;

       protected $paginationTheme = 'bootstrap';protected $listeners = ['unalbumUpdate' => 'refresh'];
public function refresh(){
    $this->albums = \App\Models\Album::orderBy('code','asc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\Album::query();
	if($this->search!==null) 
	$qr=\App\Models\Album::where('projet_id',$this->search);
	$this->albums=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unalbum=\App\Models\Album::find($this->sid);
	return view('livewire.reporting.albums.album-liste',
	   ['albums'=>$this->albums,'album'=>$this->unalbum]);
}

public function resetAlbum() {
	 $this->projet_id  = '';
	 $this->titre  = '';
	 $this->date_photos  = '';
}
}