<?php
namespace App\Livewire\Projet\Odds;
use Livewire\Component;
use \App\Traits\OddTrait;
use \App\Models\Odd;
use Livewire\WithPagination;
class OddListe extends Component {
use OddTrait;
use WithPagination;

       protected $paginationTheme = 'bootstrap';protected $listeners = ['unoddUpdate' => 'refresh'];
public function refresh(){
    $this->odds = \App\Models\Odd::orderBy('code','asc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\Odd::query();
	if($this->search!==null) 
	$qr=\App\Models\Odd::where('nom',$this->search);
	$this->odds=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unodd=\App\Models\Odd::find($this->sid);
	return view('livewire.projet.odds.odd-liste',
	   ['odds'=>$this->odds,'odd'=>$this->unodd]);
}

public function resetOdd() {
	 $this->nom  = '';
}
}