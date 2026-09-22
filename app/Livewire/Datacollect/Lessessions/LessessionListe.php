<?php
namespace App\Livewire\Datacollect\Lessessions;
use Livewire\Component;
use \App\Traits\LessessionTrait;
use \App\Models\Lessession;
use Livewire\WithPagination;
class LessessionListe extends Component {
use LessessionTrait;
use WithPagination;
public $site_id = null;
    public $groupement_id = null;
    public $localite_id ,$fid,$lsid=5;
    
    public $membre_id = null;
       protected $paginationTheme = 'bootstrap';protected $listeners = ['lessessionUpdate' => 'refresh'];
public function updatedLocaliteId($value)
{
    // Find the site that belongs to this localite
    if ($value) {
        $site = \App\Models\Site::where('projet_id', session()->get('pid'))
            ->where('localite_id', $value)
            ->first();
        $this->site_id = $site ? $site->id : null;
        // Reset groupement when localite changes
        $this->groupement_id = null;
    } else {
        $this->site_id = null;
    }
}
public function voir($l){
    $this->lsid=$l;
    $this->dispatch('lsidupdated', lid: $l);
}
public function updatedSiteId($value)
{
    // Reset groupement when site changes
    $this->groupement_id = null;
    $this->page=1;
}
public function render() {
	$projetId = session()->get('pid');
	$qr=\App\Models\Lessession::whereHas('groupement', function ($query) use ($projetId) {
		$query->where('projet_id', $projetId);
	});
	$locs=[];
	$projet=\App\Models\Projet::find($projetId);
	if($projet && $projet->sites) {
	foreach($projet->sites as $s)
	  $locs[$s->localite->id]=utf8_decode($s->localite->nom_localite);
	}
	if($this->site_id!==null) 
     $qr->where('site_id',$this->site_id);
     
     if($this->groupement_id!==null) 
     $qr->where('groupement_id',$this->groupement_id);

	$stats = $this->getProjectStats($projetId, clone $qr);
	$this->lessessions=$qr->orderBy('date_session','desc')->paginate(10);
	$this->unlessession=\App\Models\Lessession::find($this->sid);
	$this->page=1;
	return view('livewire.datacollect.lessessions.lessession-liste',
	   ['lessessions'=>$this->lessessions,'lessession'=>$this->unlessession,'locs'=>$locs,'stats'=>$stats]);
}

private function getProjectStats($projetId, $sessionsQuery): array
{
	$sitesQuery = \App\Models\Site::where('projet_id', $projetId);
	$groupementsQuery = \App\Models\Groupement::where('projet_id', $projetId);

	if ($this->localite_id) {
		$sitesQuery->where('localite_id', $this->localite_id);
		$groupementsQuery->whereHas('site', function ($query) {
			$query->where('localite_id', $this->localite_id);
		});
	}

	if ($this->site_id) {
		$groupementsQuery->where('site_id', $this->site_id);
	}

	if ($this->groupement_id) {
		$groupementsQuery->whereKey($this->groupement_id);
	}

	$groupements = $groupementsQuery->with('membres:id')->get();
	$groupementIds = $groupements->pluck('id')->unique();
	$membreIds = $groupements
		->flatMap(fn ($groupement) => $groupement->membres->pluck('id'))
		->unique();
	$sessionIds = (clone $sessionsQuery)->pluck('id');
	$donnees = \App\Models\MetaDonnee::whereIn('lessession_id', $sessionIds);
	$participations = (clone $donnees)->count();
	$sessions = (clone $sessionsQuery)->with('groupement.membres')->get();
	$participantsAttendus = $sessions->sum(
		fn ($session) => $session->groupement?->membres->count() ?? 0
	);

	return [
		'sites' => $sitesQuery->distinct()->count('sites.id'),
		'foyers' => $groupementIds->count(),
		'membres' => $membreIds->count(),
		'referes' => (clone $donnees)
			->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(donnes, '$.refere')) = ?", ['Oui'])
			->count(),
		'croissance_normale' => (clone $donnees)
			->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(donnes, '$.cs')) = ?", ['normal'])
			->count(),
		'retard_croissance' => (clone $donnees)
			->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(donnes, '$.cs')) = ?", ['retard croissance'])
			->count(),
		'taux_participation' => $participantsAttendus > 0
			? round(($participations / $participantsAttendus) * 100, 1)
			: 0,
	];
}
 public function onGroupementUpdated()
    {
        // Your custom logic here
        $this->dispatch('groupement-changed', ggid: $this->groupement_id, ssid:$this->site_id);
       
    }
public function resetLessession() {
	 
	 $this->site_id  = '';
	 $this->date_session  = '';
	 $this->groupement_id  = '';
}
public function rea(){
	$this->lessessions=\App\Models\Lessession::whereHas('groupement', function ($query) {
		$query->where('projet_id', session()->get('pid'));
	})->orderBy('date_session','desc')->paginate(10);
    	$this->render();
    //	dd('re');
      //return redirect(request()->header('Referer'));
}
public function openDonneesModal($sid, $gid)
{
    $this->dispatch('show-modal', 
        'Donnees',  // title (string)
        [           // content (array)
            'type' => 'component',
            'name' => 'show-membres',
            'key' => 'show-membres-' . $sid . '-' . $gid,
            'params' => [
                'sid' => $sid,
                'gid' => $gid
            ]
        ],
        'modal-lg', // size (optional, string)
        []          // options (optional, array)
    );
}

public function editModal($sid)
{
    dd('hh');
    $this->dispatch('show-modal', 
        'Modifier',  // title (string)
        [           // content (array)
            'type' => 'component',
            'name' => 'datacolect.lessessions.lessession-edit',
            'key' => 'lesssession-' . $sid,
            'params' => [
                'sid' => $sid,
            
            ]
        ],
        'modal-lg', // size (optional, string)
        []          // options (optional, array)
    );
}
}
