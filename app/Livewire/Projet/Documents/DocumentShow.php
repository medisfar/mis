<?php
namespace App\Livewire\Projet\Documents;
use Livewire\Component;
use \App\Traits\DocumentTrait;
use \App\Models\Document;
class DocumentShow extends Component {
use DocumentTrait;
public function mount($id) {
	$this->sid=$id;
	$this->editDocument($this->sid);}
protected $listeners = ['undocumentUpdate' => 'refresh'];
public function refresh(){
    $this->documents = \App\Models\Document::orderBy('code','asc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\Document::query();
	$this->documents=$qr->paginate(20);
	if($this->sid!==null) 
	$this->undocument=\App\Models\Document::find($this->sid);
	return view('livewire.projet.documents.document-show',
	   ['documents'=>$this->documents,'document'=>$this->undocument]);
}

public function resetDocument() {
	 $this->projet_id  = '';
	 $this->titre  = '';
	 $this->fichier  = '';
}
}