<?php

namespace App\Livewire\Datacollect\Collectes;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\MetaDonnee;
use App\Models\Projet;
use App\Models\Site;
use App\Models\Groupement;
use App\Models\Membre;
use Illuminate\Support\Facades\DB;

class CollecteListe extends Component
{
    use WithPagination;
    
    public $site_id = null;
    public $groupement_id = null;
    public $localite_id = 7;
    public $search = '';
    public $membre_id = null;
    
    protected $paginationTheme = 'bootstrap';
    protected $queryString = ['search', 'localite_id', 'site_id', 'groupement_id', 'membre_id'];
    
    // Reset pagination when filters change
    public function updatingSearch()
    {
        $this->resetPage();
    }
    
    public function updatingLocaliteId()
    {
        $this->resetPage();
        $this->site_id = null;
        $this->groupement_id = null;
    }
    
    public function updatingSiteId()
    {
        $this->resetPage();
        $this->groupement_id = null;
    }
    
    public function updatingGroupementId()
    {
        $this->resetPage();
    }
    
    public function updatingMembreId()
    {
        $this->resetPage();
    }
    
    public function render()
    {
       
        $qr=\App\Models\Lessession::query();
        
        if ($this->site_id) {
            $query->where('site_id', $this->site_id);
        }
        
        if ($this->groupement_id) {
            $query->where('lgroupement_id', $this->groupement_id);
        }
        // If the column is JSON type and you want to check for empty array
$lessessions = \App\Models\Lessession::orderBy('created_at','desc')->paginate(20);
        
        //$users = User::doesntHave('posts.comments')->get();
       //$lessessions= \App\Models\Lessession::whereHas('donnees',function($qr2){
           // $qr2->where('donnes','[]');})->get();//orderBy('id', 'desc')->paginate(5,'*','ss');
     // dd($lessessions);
        return view('livewire.datacollect.collectes.collecte-liste', [
            'collectes' =>$lessessions,
            'locs' => [],
            // 'sql' => $sql . ' | ' . implode(', ', $bindings)
        ]);
    }
    
    private function getLocalites(): array
    {
        // Use cache or a more efficient query instead of loading full project
        return Site::whereNotNull('localite_id')
                   ->with('localite')
                   ->get()
                   ->pluck('localite.nom_localite', 'localite.id')
                   ->toArray();
        
        // Or if you need project-specific:
        // return Projet::find(11)?->sites()
        //     ->whereNotNull('localite_id')
        //     ->with('localite')
        //     ->get()
        //     ->pluck('localite.nom_localite', 'localite.id')
        //     ->toArray() ?? [];
    }
    
    public function destroyCollecte($id)
    {
        try {
            $collecte = MetaDonnee::find($id);
            if ($collecte) {
                $collecte->delete();
                session()->flash('message', 'Collecte supprimée avec succès');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Erreur lors de la suppression: ' . $e->getMessage());
        }
    }
}