<?php
namespace App\Livewire\Projet\Resultats;
use Livewire\Component;
use \App\Traits\ResultatTrait;
use \App\Models\Resultat;
class ResultatShow extends Component {
use ResultatTrait;
public $ppid,$odid;
public function mount($id) {
	$this->sid=$id;
	$this->editResultat($this->sid);}
protected $listeners = ['unresultatUpdate' => 'refresh'];
public function refresh(){
    $this->resultats = \App\Models\Resultat::orderBy('code','asc')->paginate(20);
    $this->render();
}
public function render() {
	$qr=\App\Models\Resultat::query();
	$this->resultats=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unresultat=\App\Models\Resultat::find($this->sid);

	return view('livewire.projet.resultats.resultat-show',
	   ['resultats'=>$this->resultats,'resultat'=>$this->unresultat]);
}

public function resetResultat() {
	 $this->projet_id  = '';
	 $this->description  = '';
}
public function add(){
    
    \DB::insert("insert into produit_resultat(produit_id,resultat_id) values($this->ppid,$this->sid)");
   // dd("insert into produit_resultat(produit_id,resultat_id) values($this->ppid,$this->sid)");
}

public function del($pr){
   
    \DB::delete("delete from produit_resultat where produit_id=$pr");
//    dd("delete from produit_resultat where resultat_id=$pr");
}

public function addo(){
    
    \DB::insert("insert into odd_resultat(odd_id,resultat_id) values($this->odid,$this->sid)");
   // dd("insert into odd_resultat(odd_id,resultat_id) values($this->odid,$this->sid)");
}

public function delo($pr){
   
    \DB::delete("delete from odd_resultat where odd_id=$pr");
//    dd("delete from produit_resultat where resultat_id=$pr");
}
}