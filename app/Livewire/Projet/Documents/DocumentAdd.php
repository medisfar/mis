<?php
namespace App\Livewire\Projet\Documents;
use Livewire\Component;
use \App\Traits\DocumentTrait;
use \App\Models\Document;
use Livewire\WithFileUploads;
class DocumentAdd extends Component {
    use WithFileUploads;
use DocumentTrait;
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
	$this->createDocument($this->sid);	return view('livewire.projet.documents.document-add',
	   ['documents'=>$this->documents,'document'=>$this->undocument]);
}

public function resetDocument() {
	 $this->projet_id  = '';
	 $this->titre  = '';
	 $this->fichier  = '';
}
}