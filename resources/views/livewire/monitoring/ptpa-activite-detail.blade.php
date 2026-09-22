<div>
    @if($mapSite)
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
            <div>
                <small class="text-muted text-uppercase font-weight-bold">Localisation du site</small>
                <h5 class="mb-0">{{ $mapSite->nom }}</h5>
            </div>
            <button type="button" class="btn btn-sm btn-outline-primary" wire:click="backToTracking">
                <i class="fas fa-arrow-left"></i> Retour au suivi
            </button>
        </div>

        <div class="row mb-3">
            <div class="col-md-4 mb-2">
                <div class="border rounded bg-light p-2 h-100">
                    <small class="text-muted d-block">Localité</small>
                    <strong>{{ $mapSite->localite->nom_localite ?? '-' }}</strong>
                </div>
            </div>
            <div class="col-md-4 mb-2">
                <div class="border rounded bg-light p-2 h-100">
                    <small class="text-muted d-block">Latitude</small>
                    <strong>{{ $mapSite->lattitude }}</strong>
                </div>
            </div>
            <div class="col-md-4 mb-2">
                <div class="border rounded bg-light p-2 h-100">
                    <small class="text-muted d-block">Longitude</small>
                    <strong>{{ $mapSite->longitude }}</strong>
                </div>
            </div>
        </div>

        <div class="border rounded overflow-hidden bg-light" style="height: 430px;">
            <iframe
                title="Carte du site {{ $mapSite->nom }}"
                src="{{ route('smap', ['lat' => $mapSite->lattitude, 'lng' => $mapSite->longitude]) }}"
                style="width: 100%; height: 100%; border: 0;"
                loading="lazy"
            ></iframe>
        </div>
    @else
        <div class="mb-3">
            <strong>{{ $activite->activite }}</strong>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>Site</th>
                        <th>Localité</th>
                        <th>Sous-activité</th>
                        <th>Budget</th>
                        <th>Période</th>
                        <th>Avancement</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($lignes as $ligne)
                        @php
                            $site = $ligne['site'];
                            $tache = $ligne['tache'];
                            $hasGps = is_numeric($site->lattitude)
                                && is_numeric($site->longitude)
                                && $site->lattitude >= -90 && $site->lattitude <= 90
                                && $site->longitude >= -180 && $site->longitude <= 180;
                        @endphp
                        <tr>
                            <td>{{ $site->nom ?: '-' }}</td>
                            <td>{{ $site->localite->nom_localite ?? '-' }}</td>
                            <td>{{ $tache?->tache ?? 'Aucune sous-activité' }}</td>
                            <td>{{ $tache ? number_format((float) $tache->budget, 0, ',', ' ') : '-' }}</td>
                            <td>
                                @if($tache)
                                    {{ \Carbon\Carbon::parse($tache->date_debut)->format('d/m/Y') }}
                                    -
                                    {{ \Carbon\Carbon::parse($tache->date_fin)->format('d/m/Y') }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ $tache ? ((int) $tache->completed).' %' : '-' }}</td>
                            <td class="text-nowrap">
                                @if($hasGps)
                                    <button type="button" class="btn btn-sm btn-success" wire:click="showMap({{ $site->id }})">
                                        <i class="fas fa-map-marker-alt"></i> Map
                                    </button>
                                @else
                                    <span class="badge badge-secondary p-2">GPS manquant</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">
                                Aucun site n’est affecté à cette activité.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @endif
</div>
