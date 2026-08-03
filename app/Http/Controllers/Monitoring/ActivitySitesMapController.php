<?php

namespace App\Http\Controllers\Monitoring;

use App\Http\Controllers\Controller;
use App\Models\Activite;

class ActivitySitesMapController extends Controller
{
    public function __invoke(int $id)
    {
        $projetId = (int) session()->get('pid');
        $activite = Activite::query()
            ->whereHas('composante', fn ($query) => $query->where('projet_id', $projetId))
            ->with('sites.localite')
            ->findOrFail($id);

        $locations = $activite->sites
            ->unique('id')
            ->filter(fn ($site) => is_numeric($site->lattitude)
                && is_numeric($site->longitude)
                && (float) $site->lattitude >= -90
                && (float) $site->lattitude <= 90
                && (float) $site->longitude >= -180
                && (float) $site->longitude <= 180)
            ->map(fn ($site) => [
                'name' => $site->nom,
                'locality' => $site->localite?->nom_localite,
                'lat' => (float) $site->lattitude,
                'lng' => (float) $site->longitude,
            ])
            ->values();

        return response()
            ->view('maps.activity-sites', compact('activite', 'locations'))
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate');
    }
}
