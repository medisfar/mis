<?php

namespace App\Livewire\Monitoring;

use App\Models\Activite;
use Livewire\Attributes\Locked;
use Livewire\Component;

class PtpaActiviteDetail extends Component
{
    #[Locked]
    public int $activiteId;

    public function mount(int $id): void
    {
        $this->activiteId = $id;
    }

    public function render()
    {
        $projetId = (int) session()->get('pid');

        $activite = Activite::query()
            ->whereHas('composante', function ($query) use ($projetId) {
                $query->where('projet_id', $projetId);
            })
            ->with([
                'sites.localite',
                'taches.site.localite',
            ])
            ->findOrFail($this->activiteId);

        $lignes = collect();

        foreach ($activite->sites->unique('id') as $site) {
            $taches = $activite->taches->where('site_id', $site->id);

            if ($taches->isEmpty()) {
                $lignes->push([
                    'site' => $site,
                    'tache' => null,
                ]);

                continue;
            }

            foreach ($taches as $tache) {
                $lignes->push([
                    'site' => $site,
                    'tache' => $tache,
                ]);
            }
        }

        return view('livewire.monitoring.ptpa-activite-detail', [
            'activite' => $activite,
            'lignes' => $lignes,
        ]);
    }
}
