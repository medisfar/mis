<?php
namespace App\Traits;
use Livewire\Component;
use \App\Models\Document;
Trait DocumentTrait {
  protected $documents,$undocument;
  public  $sid,$state='home',$search;
  public $projet_id,$titre,$fichier;

public function resetDocument() {
	 $this->projet_id  = '';
	 $this->titre  = '';
	 $this->fichier  = '';
}

public function cancelDocument() {
	 $this->state       = 'home';
}

public function createDocument() {
	 $this->state       = 'create';
 	$this->sid = null;
	$this->undocument = new Document;
}

public function storeDocument() {
	$this->validate([
 	'projet_id'    => 'required', 
 	'titre'    => 'required', 
 	'fichier'    => 'required', 
	]);
	$undocument = new Document;
	$filePath = null;
	if ($this->fichier) {
	    // Store the file in the 'documents' directory on the 'public' disk
	    $filePath = $this->fichier->store('documents', 'public');
	}
	
	$undocument->create([
 	'projet_id'    => $this->projet_id, 
 	'titre'    => $this->titre, 
 	'fichier'    => $filePath, 
	]);
	$this->resetDocument();
	 return redirect()->route('projet.documents');
}

public function showDocument($id) {
	 $this->state       = 'show';
 	$this->sid = $id;
	$this->undocument =  Document::find($id);
 	$this->projet_id    = $this->undocument->projet_id; 
 	$this->titre    = $this->undocument->titre; 
 	$this->fichier    = $this->undocument->fichier; 
}

public function editDocument($id) {
	 $this->state       = 'edit';
 	$this->sid = $id;
	$this->undocument =  Document::find($id);
if($this->undocument != null) {
 	$this->projet_id    = $this->undocument->projet_id; 
 	$this->titre    = $this->undocument->titre; 
 	$this->fichier    = $this->undocument->fichier; 
}}

public function updateDocument() {
	$this->validate([
 	'projet_id'    => 'required', 
 	'titre'    => 'required', 
 	'fichier'    => 'required', 
	]);
	if ($this->sid) {
   $undocument = Document::find($this->sid);
	$undocument->update([
 	'projet_id'    => $this->projet_id, 
 	'titre'    => $this->titre, 
 	'fichier'    => $this->fichier, 
	]);
	$this->resetDocument();
	 return redirect()->route('projet.documents');

}}

public function destroyDocument($id)
{
 if ($id) {
  	   $undocument = Document::find( $id);
   	 $undocument->delete();
	}


	 return redirect()->route('projet.documents');
}

}
