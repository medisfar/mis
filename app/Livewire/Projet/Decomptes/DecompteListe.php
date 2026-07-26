<?php
namespace App\Livewire\Projet\Decomptes;
use Livewire\Component;
use \App\Traits\DecompteTrait;
use \App\Models\Decompte;
use Livewire\WithPagination;
class DecompteListe extends Component {
use DecompteTrait;
use WithPagination;

       protected $paginationTheme = 'bootstrap';public function render() {
	$qr=\App\Models\Decompte::query();
	if($this->search!==null) 
	$qr=\App\Models\Decompte::where('activite_id',$this->search);
	$this->decomptes=$qr->paginate(20);
	if($this->sid!==null) 
	$this->undecompte=\App\Models\Decompte::find($this->sid);
	return view('livewire.projet.decomptes.decompte-liste',
	   ['decomptes'=>$this->decomptes,'decompte'=>$this->undecompte]);
}
#[on('decompteUpdate')]
public function handle0(){
     $this->resetPage(); 
}
public function resetDecompte() {
	 $this->activite_id  = '';
	 $this->date_previsionnelle  = '';
	 $this->pourcentage  = '';
	 $this->date_effective  = '';
}
}