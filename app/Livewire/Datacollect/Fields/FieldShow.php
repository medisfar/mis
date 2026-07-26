<?php
namespace App\Livewire\Datacollect\Fields;
use Livewire\Component;
use \App\Traits\FieldTrait;
use \App\Models\Field;
class FieldShow extends Component {
use FieldTrait;
public function mount($id) {
	$this->sid=$id;
	$this->editField($this->sid);}
protected $listeners = ['unfieldUpdate' => 'refresh'];
public function refresh(){
    $this->fields = \App\Models\Field::orderBy('code','asc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\Field::query();
	$this->fields=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unfield=\App\Models\Field::find($this->sid);
	return view('livewire.datacollect.fields.field-show',
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