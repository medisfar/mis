<?php
namespace App\Livewire\Reporting\Documents;
use Livewire\Component;
use \App\Traits\documentTrait;
use \App\Models\document;
use Livewire\WithPagination;
class documentListe extends Component {
use documentTrait;
use WithPagination;

       protected $paginationTheme = 'bootstrap';protected $listeners = ['undocumentUpdate' => 'refresh'];
public function refresh(){
    $this->Documents = \App\Models\document::orderBy('code','asc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\document::query();
	if($this->search!==null) 
	$qr=\App\Models\document::where('',$this->search);
	$this->Documents=$qr->paginate(20);
	if($this->sid!==null) 
	$this->undocument=\App\Models\document::find($this->sid);
	return view('livewire.reporting.documents.document-liste',
	   ['Documents'=>$this->Documents,'document'=>$this->undocument]);
}

public function resetdocument() {
}
}