<?php
namespace App\Livewire\Datacollect\Fields;
use Livewire\Component;
use \App\Traits\FieldTrait;
use \App\Models\Field;
class FieldAdd extends Component {
use FieldTrait;
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
	$this->createField($this->sid);	return view('livewire.datacollect.fields.field-add',
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