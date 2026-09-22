<?php
namespace App\Livewire\Reporting\Documents;
use Livewire\Component;
use \App\Traits\documentTrait;
use \App\Models\document;
class documentAdd extends Component {
use documentTrait;
protected $listeners = ['undocumentUpdate' => 'refresh'];
public function refresh(){
    $this->Documents = \App\Models\document::orderBy('code','asc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\document::query();
	$this->Documents=$qr->paginate(20);
	if($this->sid!==null) 
	$this->undocument=\App\Models\document::find($this->sid);
	$this->createdocument($this->sid);	return view('livewire.reporting.documents.document-add',
	   ['Documents'=>$this->Documents,'document'=>$this->undocument]);
}

public function resetdocument() {
}
}