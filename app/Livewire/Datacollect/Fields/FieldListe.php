<?php
namespace App\Livewire\Datacollect\Fields;
use Livewire\Component;
use \App\Traits\FieldTrait;
use \App\Models\Field;
use Livewire\WithPagination;
class FieldListe extends Component {
use FieldTrait;
use WithPagination;

       protected $paginationTheme = 'bootstrap';protected $listeners = ['unfieldUpdate' => 'refresh'];
public function refresh(){
    $this->fields = \App\Models\Field::orderBy('code','asc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\Field::query();
	if($this->search!==null) 
	$qr=\App\Models\Field::where('nom',$this->search);
	$this->fields=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unfield=\App\Models\Field::find($this->sid);
	return view('livewire.datacollect.fields.field-liste',
	   ['fields'=>$this->fields,'field'=>$this->unfield]);
}

public function resetField() {
	 $this->nom  = '';
	 $this->psession_id  = '';
	 $this->row  = '';
	 $this->col  = '';
	 $this->options  = '';
}
}