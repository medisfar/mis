<?php

namespace App\Livewire\Monitoring;

use App\Models\Activite;
use Livewire\Attributes\Locked;
use Livewire\Component;

class PtpaActiviteMap extends Component
{
    #[Locked]
    public int $activiteId;

    public function mount(int $id): void
    {
        $this->activiteId = $id;
    }

    public function render()
    {
        $activite = $this->activityQuery()->with('sites.localite')->findOrFail($this->activiteId);
        $sites = $activite->sites->unique('id');
        $mappedSites = $sites->filter(fn ($site) => $this->hasValidGps($site));
        $missingSites = $sites->reject(fn ($site) => $this->hasValidGps($site));

        return view('livewire.monitoring.ptpa-activite-map', [
            'activite' => $activite,
            'sites' => $sites,
            'mappedSites' => $mappedSites,
            'missingSites' => $missingSites,
            'mapUrl' => route('monitoring.activites.map', $activite->id),
        ]);
    }

    private function activityQuery()
    {
        $projetId = (int) session()->get('pid');

        return Activite::query()->whereHas(
            'composante',
            fn ($query) => $query->where('projet_id', $projetId)
        );
    }

    private function hasValidGps($site): bool
    {
        return is_numeric($site->lattitude)
            && is_numeric($site->longitude)
            && (float) $site->lattitude >= -90
            && (float) $site->lattitude <= 90
            && (float) $site->longitude >= -180
            && (float) $site->longitude <= 180;
    }
}
