<?php

namespace App\Livewire;

use \App\Models\Projet;
use Livewire\Component;

class MonitoringIndex extends Component
{
    public $cid;

    public function render()
    {
        $projetId = session()->get('pid');

        $projet = null;
        if ($projetId) {
            $projet = Projet::with([
                'composantes.activites.taches',
                'composantes.activites.decomptes',
                'composantes.activites.sousComposante',
                'composantes.activites.composante',
            ])->find($projetId);
        }

        return view('livewire.monitoring.index', [
            'projet' => $projet,
        ]);
    }
}
