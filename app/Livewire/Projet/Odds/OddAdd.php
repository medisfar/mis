<?php
namespace App\Livewire\Projet\Odds;
use Livewire\Component;
use \App\Traits\OddTrait;
use \App\Models\Odd;
class OddAdd extends Component {
use OddTrait;
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
	$this->createOdd($this->sid);	return view('livewire.projet.odds.odd-add',
	   ['odds'=>$this->odds,'odd'=>$this->unodd]);
}

public function resetOdd() {
	 $this->nom  = '';
}
}