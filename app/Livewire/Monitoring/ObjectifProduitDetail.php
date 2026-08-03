<?php

namespace App\Livewire\Monitoring;

use App\Models\ActiviteProduit;
use Livewire\Attributes\Locked;
use Livewire\Component;

class ObjectifProduitDetail extends Component
{
    #[Locked]
    public array $contributionIds = [];

    public function mount(array $contributionIds): void
    {
        $this->contributionIds = collect($contributionIds)
            ->filter(fn ($id) => is_numeric($id))
            ->map(fn ($id) => (int) $id)
            ->unique()
            ->values()
            ->all();
    }

    public function render()
    {
        $contributions = ActiviteProduit::query()
            ->whereIn('id', $this->contributionIds)
            ->whereHas('produit.resultat.mission')
            ->whereHas('activite')
            ->with([
                'activite.composante.projet',
                'activite.sites.localite',
                'activite.taches.site.localite',
            ])
            ->get();

        return view('livewire.monitoring.objectif-produit-detail', [
            'contributions' => $contributions,
            'activites' => $contributions
                ->pluck('activite')
                ->filter()
                ->unique('id')
                ->values(),
        ]);
    }
}
