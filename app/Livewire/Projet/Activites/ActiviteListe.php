<?php
namespace App\Livewire\Projet\Activites;
use Livewire\Component;
use \App\Traits\ActiviteTrait;
use \App\Models\Activite;
use Livewire\WithPagination;
class ActiviteListe extends Component {
use ActiviteTrait;
use WithPagination;

       protected $paginationTheme = 'bootstrap';public function render() {
	$qr=\App\Models\Activite::query();
	$qr->where('composante_id',$this->cid);
	if($this->search!==null) 
	$qr=\App\Models\Activite::where('activite','like','%'.$this->search.'%');
if($this->composante_id!==null) 
	$qr=\App\Models\Activite::where('composantet_id',$this->composantet_id);
	$this->activites=$qr->paginate(20);
	if($this->sid!==null) 
	$this->unactivite=\App\Models\Activite::find($this->sid);
	return view('livewire.projet.activites.activite-liste',
	   ['activites'=>$this->activites,'activite'=>$this->unactivite]);
}

public function updatedCpid()
{
    $this->resetPage(); // if using WithPagination
    // or $this->page = 1;
}

public function updatedActiviteId()
{
    $this->resetPage();
}

public function updatedSiteId()
{
    $this->resetPage();
}
public function resetActivite() {
	 $this->activite  = '';
	 $this->composante_id  = '';
	 $this->sous_composante_id  = '';
	 $this->date_debut  = '';
	 $this->date_fin  = '';
	 $this->budget  = '';
	 $this->completed  = '';
}
}