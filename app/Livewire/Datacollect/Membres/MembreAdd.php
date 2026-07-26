<?php
namespace App\Livewire\Datacollect\Membres;
use Livewire\Component;
use \App\Traits\MembreTrait;
use \App\Models\Membre;
use Faker\Factory as Faker;
class MembreAdd extends Component {
use MembreTrait;
protected $listeners = ['unmembreUpdate' => 'refresh'];
public $idm;
public function mount($idm=null) {
	
	if($this->idm!==null) 
	$this->menage_id=$idm;
	}
public function refresh(){
    $this->membres = \App\Models\Membre::orderBy('code','asc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\Membre::query();
	$this->membres=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unmembre=\App\Models\Membre::find($this->sid);
	$this->createMembre($this->sid);	return view('livewire.datacollect.membres.membre-add',
	   ['membres'=>$this->membres,'membre'=>$this->unmembre]);
}

public function resetMembre() {
	 $this->menage_id  = '';
	 $this->genre  = '';
	 $this->nom  = '';
	 $this->date_naissance  = '';
	 $this->lien_parente  = '';
	 $this->enceinte  = '';
}

public function remplir(){

$faker = Faker::create();
	 $this->genre  = 1;
	 $this->nom  = \App\Uts::gennom('M'); 
	 $this->date_naissance  = $faker->dateTimeBetween('-10 year', 'now')->format('Y-m-d');

;
	 $this->lien_parente  = 1;
	 $this->enceinte  = 0;
}
}