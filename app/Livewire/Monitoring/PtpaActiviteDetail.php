<?php

namespace App\Livewire\Monitoring;

use App\Models\Activite;
use Livewire\Attributes\Locked;
use Livewire\Component;

class PtpaActiviteDetail extends Component
{
    #[Locked]
    public int $activiteId;

    #[Locked]
    public ?int $mapSiteId = null;

    public function mount(int $id): void
    {
        $this->activiteId = $id;
    }

    public function showMap(int $siteId): void
    {
        $projetId = (int) session()->get('pid');

        $siteExists = Activite::query()
            ->whereKey($this->activiteId)
            ->whereHas('composante', fn ($query) => $query->where('projet_id', $projetId))
            ->whereHas('sites', function ($query) use ($siteId) {
                $query->where('sites.id', $siteId)
                    ->whereNotNull('sites.lattitude')
                    ->whereNotNull('sites.longitude')
                    ->whereBetween('sites.lattitude', [-90, 90])
                    ->whereBetween('sites.longitude', [-180, 180]);
            })
            ->exists();

        if ($siteExists) {
            $this->mapSiteId = $siteId;
        }
    }

    public function backToTracking(): void
    {
        $this->mapSiteId = null;
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

        $mapSite = $this->mapSiteId
            ? $activite->sites->firstWhere('id', $this->mapSiteId)
            : null;

        if ($this->mapSiteId && ! $mapSite) {
            $this->mapSiteId = null;
        }

        return view('livewire.monitoring.ptpa-activite-detail', [
            'activite' => $activite,
            'lignes' => $lignes,
            'mapSite' => $mapSite,
        ]);
    }
}
