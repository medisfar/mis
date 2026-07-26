<?php
namespace App\Livewire\Projet\Odds;
use Livewire\Component;
use \App\Traits\OddTrait;
use \App\Models\Odd;
class OddEdit extends Component {
use OddTrait;
public function mount($id) {
	$this->sid=$id;
	$this->editOdd($this->sid);}
protected $listeners = ['unoddUpdate' => 'refresh'];
public function refresh(){
    $this->odds = \App\Models\Odd::orderBy('code','asc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\Odd::query();
	$this->odds=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unodd=\App\Models\Odd::find($this->sid);
	return view('livewire.projet.odds.odd-edit',
	   ['odds'=>$this->odds,'odd'=>$this->unodd]);
}

public function resetOdd() {
	 $this->nom  = '';
}
}