<?php
namespace App\Livewire\Monitoring\Decomptes;
use Livewire\Component;
use \App\Traits\DecompteTrait;
use \App\Models\Decompte;
use Livewire\WithPagination;
class DecompteListe extends Component {
use DecompteTrait;
use WithPagination;

       protected $paginationTheme = 'bootstrap';protected $listeners = ['undecompteUpdate' => 'refresh'];
public function refresh(){
    $this->decomptes = \App\Models\Decompte::orderBy('code','asc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\Decompte::query();
	if($this->search!==null) 
	$qr=\App\Models\Decompte::where('activite_id',$this->search);
	$this->decomptes=$qr->paginate(20);
	if($this->sid!==null) 
	$this->undecompte=\App\Models\Decompte::find($this->sid);
	return view('livewire.monitoring.decomptes.decompte-liste',
	   ['decomptes'=>$this->decomptes,'decompte'=>$this->undecompte]);
}

public function resetDecompte() {
	 $this->activite_id  = '';
	 $this->site_id  = '';
	 $this->montant  = '';
	 $this->date_effective  = '';
}
}