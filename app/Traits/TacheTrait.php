<?php
namespace App\Traits;
use Livewire\Component;
use \App\Models\Activite;
use \App\Models\Tache;
Trait TacheTrait {
  protected $taches,$untache;
  public  $sid,$state='home',$search;
  public $pid,$cpid,$tache,$composante_id,$activite_id,$site_id,$date_debut,$date_fin,$completed,$budget,$engage;

public function resetTache() {
	 $this->tache  = '';
	 $this->activite_id  = '';
	 	 $this->budget=  '';
	 	 	 $this->engage= '';
	  $this->site_id  = '';
	 $this->date_debut  = '';
	 $this->date_fin  = '';
	 $this->completed  = '';
}

public function cancelTache() {
	 $this->state       = 'home';
}

public function updatedActiviteId() {
	$this->site_id = '';
}

public function createTache() {
	 $this->state       = 'create';
 	$this->sid = null;
	$this->untache = new Tache;
}

public function storeTache() {
	$activite = $this->validateTacheContext();

	if (! $activite) {
		return;
	}

	$untache = new Tache;
	$untache->create([
 	'tache'    => $this->tache,
 	'budget'    => $this->budget,
 	'engage'    => $this->engage,
 	'activite_id'    => $this->activite_id, 
 	'site_id'    => $this->site_id, 
 	'date_debut'    => $this->date_debut, 
 	'date_fin'    => $this->date_fin, 
 	'completed'    => $this->completed, 
	'projet_id' => $activite->composante->projet_id,
	]);
	$this->resetTache();
	 $this->dispatch('tacheUpdate');
   $this->dispatch('hide-modal');
}

public function showTache($id) {
	 $this->state       = 'show';
 	$this->sid = $id;
	$this->untache =  Tache::find($id);
	$this->tache    = $this->untache->tache; 
 	$this->budget    = $this->untache->budget; 
 	$this->engage    = $this->untache->engage; 
 	$this->site_id    = $this->untache->site_id; 
 	$this->activite_id    = $this->untache->activite_id; 
 	$this->date_debut    = $this->untache->date_debut; 
 	$this->date_fin    = $this->untache->date_fin; 
 	$this->completed    = $this->untache->completed; 
}

public function editTache($id) {
	 $this->state       = 'edit';
 	$this->sid = $id;
	$this->untache =  Tache::find($id);
if($this->untache != null) {
 	$this->tache    = $this->untache->tache; 
 	$this->activite_id    = $this->untache->activite_id; 
 		$this->budget    = $this->untache->budget; 
 			$this->engage    = $this->untache->engage; 
 	$this->site_id    = $this->untache->site_id; 
 	$this->date_debut    = $this->untache->date_debut; 
 	$this->date_fin    = $this->untache->date_fin; 
 	$this->completed    = $this->untache->completed; 
}}

public function updateTache() {
	$activite = $this->validateTacheContext();

	if (! $activite) {
		return;
	}

	if ($this->sid) {
   $untache = Tache::where('projet_id', session()->get('pid'))->find($this->sid);

   if (! $untache) {
       $this->addError('tache', 'Cette sous-activité ne fait pas partie du projet sélectionné.');
       return;
   }

	$untache->update([
 	'tache'    => $this->tache, 
 	'budget'    => $this->budget, 
 	'engage'    => $this->engage,
 	'activite_id'    => $this->activite_id, 
 	'site_id'    => $this->site_id, 
 	'date_debut'    => $this->date_debut, 
 	'date_fin'    => $this->date_fin, 
 	'completed'    => $this->completed, 
 	
	'projet_id' => $activite->composante->projet_id,
	]);
	$this->resetTache();
	$this->dispatch('hide-modal');

}}

public function destroyTache($id)
{
 if ($id) {
	   $untache = Tache::where('projet_id', session()->get('pid'))->find($id);

	   if ($untache) {
	       $untache->delete();
	   }
	}


	 
}

protected function validateTacheContext(): ?Activite
{
	$this->validate([
		'tache' => 'required|string|max:255',
		'budget' => 'required|numeric|min:0',
		'engage' => 'required|numeric|min:0',
		'activite_id' => 'required|integer',
		'site_id' => 'required|integer',
		'date_debut' => 'required|date',
		'date_fin' => 'required|date|after_or_equal:date_debut',
		'completed' => 'required|integer|min:0|max:100',
	]);

	$projetId = (int) session()->get('pid');
	$activite = Activite::query()
		->with('composante')
		->whereKey($this->activite_id)
		->whereHas('composante', function ($query) use ($projetId) {
			$query->where('projet_id', $projetId);
		})
		->first();

	if (! $activite) {
		$this->addError(
			'activite_id',
			'L’activité sélectionnée ne fait pas partie du projet courant.'
		);

		return null;
	}

	$siteEstAutorise = $activite->sites()
		->where('sites.id', $this->site_id)
		->exists();

	if (! $siteEstAutorise) {
		$this->addError(
			'site_id',
			'Ce site n’est pas affecté à l’activité sélectionnée.'
		);

		return null;
	}

	return $activite;
}

}
