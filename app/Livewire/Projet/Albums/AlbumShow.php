<?php
namespace App\Livewire\Projet\Albums;
use Livewire\Component;
use \App\Traits\AlbumTrait;
use \App\Models\Album;
use Livewire\WithFileUploads;
class AlbumShow extends Component {
use AlbumTrait;
use WithFileUploads;
//public $album;
    public $titre;
    public $description;
    public $date_photo;
    public $photo;
    
public function mount($id) {
	$this->sid=$id;
	$this->editAlbum($this->sid);}
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
	return view('livewire.projet.albums.album-show',
	   ['albums'=>$this->albums,'album'=>$this->unalbum]);
}
 public function uploadPhoto()
    {
        $this->validate([
            'photo' => 'required|image|max:2048', // 2MB max
            'titre' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'date_photo' => 'nullable|date',
        ]);

        // Store the photo
        $originalName = $this->photo->getClientOriginalName();
$newName = time() . '_' . $originalName;
$path = $this->photo->storeAs('photos', $newName, 'public');
      

        // Create photo record
        $newPhoto = new \App\Models\Photo();
        $newPhoto->titre = 'Photo';
        $newPhoto->description = $this->description;
        $newPhoto->date_photo = $this->date_photo ?? now();
        $newPhoto->url = '/photos/' . $newName;
        $newPhoto->album_id = $this->sid;
        $newPhoto->save();

    }

public function resetAlbum() {
	 $this->projet_id  = '';
	 $this->titre  = '';
	 $this->date_photos  = '';
}
}