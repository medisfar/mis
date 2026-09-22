<?php
namespace App\Livewire\Microfinance\Credits;
use Livewire\Component;
use \App\Traits\CreditTrait;
use \App\Models\Credit;
class CreditAdd extends Component {
use CreditTrait;
public $foyer_id = '';

protected $listeners = ['uncreditUpdate' => 'refresh'];

public function updatedFoyerId() {
	$this->membre_id = '';
}

public function refresh(){
    $this->credits = \App\Models\Credit::orderBy('code','asc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\Credit::query();
	$this->credits=$qr->paginate(20);
	$foyers = \App\Models\Groupement::whereHas('site', function ($query) {
		$query->where('projet_id', session()->get('pid'));
	})->orderBy('nom_groupe')->pluck('nom_groupe', 'id')->prepend('', '');
	$membres = $this->foyer_id
		? \App\Models\Membre::whereHas('groupement', function ($query) {
			$query->where('groupements.id', $this->foyer_id);
		})->orderBy('nom')->pluck('nom', 'id')->prepend('', '')
		: collect(['' => '']);
	if($this->sid!==null) 
	$this->uncredit=\App\Models\Credit::find($this->sid);
	$this->createCredit($this->sid);	return view('livewire.microfinance.credits.credit-add',
	   ['credits'=>$this->credits,'credit'=>$this->uncredit,'foyers'=>$foyers,'membres'=>$membres]);
}

public function resetCredit() {
	 $this->foyer_id  = '';
	 $this->membre_id  = '';
	 $this->date_octroi  = '';
	 $this->date_premiere_echeance  = '';
	 $this->montant_echeance  = '';
	 $this->nbre_echeance  = '';
	 $this->termine  = '';
}
}
