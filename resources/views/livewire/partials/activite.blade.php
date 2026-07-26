@php
\App\Models\Activite::repos();
    $activite = \App\Models\Activite::find($idm);

@endphp

<div>
    <div class="activite-details">
        <!-- En-tête avec informations principales -->
        <div class="d-flex align-items-center mb-3">
            <div class="activite-icon me-3">
                <i class="bi bi-diagram-3 fs-5 text-primary"></i>
            </div>
            <div>
                <div class="d-flex align-items-center gap-2 mb-1">
                    <h2 class="h3 mb-0">Activite  {{ $activite->position}}</h2>
                </div>
                @if($activite->activite)
                    <p class="mb-0"><strong>>{{ $activite->activite }}</strong></p>
                @endif
            </div>
        </div>

        <div class="row g-3 mb-4">
            <!-- Budget total -->
            <div class="col-md-3">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="bg-light rounded-circle p-3">
                                    <i class="bi bi-pie-chart fs-4 text-primary"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="text-muted mb-1">Budget</h6>
                                <h5 class="mb-0">{{ number_format($activite->budget, 0, ',', ' ') }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Budget total -->
            <div class="col-md-3">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="bg-light rounded-circle p-3">
                                    <i class="bi bi-pie-chart fs-4 text-primary"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="text-muted mb-1">Engage</h6>
                                <h5 class="mb-0">{{ number_format($activite->engage, 0, ',', ' ') }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Montant décaissé -->
            <div class="col-md-3">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="bg-light rounded-circle p-3">
                                    <i class="bi bi-cash-stack fs-4 text-success"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="text-muted mb-1">Décaissé</h6>
                                <h5 class="mb-0 text-success">{{ number_format($activite->decaisse, 0, ',', ' ') }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pourcentage d'exécution -->
            <div class="col-md-3">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="bg-light rounded-circle p-3">
                                    <i class="bi bi-percent fs-4 text-info"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="text-muted mb-1">Taux d'exécution</h6>
                                @php
                                    $budget = ($activite->budget ?? 0);
                                    $decaisse = ($activite->decaisse ?? 0);
                                    $globalPercentage = \number_format($decaisse / $budget * 100, 2, ',', ' ');
                                @endphp
                                <h3 class="mb-0 text-info">{{ $globalPercentage }}%</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tableau des activités -->
        @if($activite && $activite->sites->count() > 0)
            @php $percentage = 0; $progressClass = ''; @endphp
            <div class="activities-section mt-4">
                <h5 class="mb-3">
                    <i class="bi bi-list-task me-2"></i>
                    {{ $activite->sites->count() }} Sites
                </h5>

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Site</th>
                                <th>Budget</th>
                                <th>Engage</th>
                                <th>Decaissé</th>
                                <th>Avancement</th>
                                <th>
                                    <button class="btn btn-sm btn-success"
                                        wire:key="mapall-{{ $activite->id }}-{{ now()->timestamp }}"
                                        wire:click="$dispatch('show-modal', { 
                                            title: '{{ addslashes($activite->activite) }}', 
                                            content: { 
                                                type: 'component', 
                                                name: 'map-many-modal', 
                                                key: 'mapall-{{ $activite->id }}-{{ now()->timestamp }}', 
                                                params: { idl: {{ $activite->id }} } 
                                            } 
                                        })">
                                        Map all
                                    </button>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($activite->sites as $index => $site)
                                <tr wire:key="site-{{ $site->id }}-{{ $activite->id }}-{{ $loop->index }}">
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="activity-indicator me-2" style="width: 4px; height: 24px; background-color: {{ $index % 2 ? '#ffc107' : '#0d6efd' }}; border-radius: 2px;"></span>
                                            <div>
                                                <strong>Site {{ $index + 1 }}</strong>
                                                @if($site->nom)
                                                    <small class="text-muted d-block">{{ $site->nom }}/{{ $site->id }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end fw-bold">{{ number_format($site->actBudget($activite->id), 0, ',', ' ') }}</td>
                                    <td class="text-end fw-bold">{{ number_format($site->actEngage($activite->id), 0, ',', ' ') }}</td>
                                    <td class="text-end">
                                        {{ number_format($site->actDecaisse($activite->id), 0, ',', ' ') }}
                                        @if($site->decaisse > $site->budget)
                                            <i class="bi bi-exclamation-triangle-fill text-danger ms-1" title="Dépassement de budget"></i>
                                        @endif
                                    </td>
                                    <td>
                                        @php  
                                            $pct = $site->budget > 0 ? (number_format($site->decaisse / $site->budget * 100, 2)) : 0;
                                            $progressClass = $pct < 30 ? 'bg-danger' : ($pct < 70 ? 'bg-warning' : 'bg-success');
                                        @endphp
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="fw-bold" style="min-width: 45px;">{{ $pct }}%</span>
                                            <div class="progress flex-grow-1" style="height: 8px;">
                                                <div class="progress-bar {{ $progressClass }}" 
                                                     role="progressbar" 
                                                     style="width: {{ min($pct, 100) }}%;" 
                                                     aria-valuenow="{{ $pct }}" 
                                                     aria-valuemin="0" 
                                                     aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-success"
                                            wire:key="view-{{ $site->id }}-{{ $activite->id }}-{{ $loop->index }}"
                                            wire:click="$dispatch('show-modal', { 
                                                title: '{{ $site->nom }}', 
                                                content: {
                                                    type: 'component',
                                                    name: 'projet.sites.site-show',
                                                    key: 'site-{{ $site->id }}-{{ $activite->id }}-{{ $loop->index }}',
                                                    params: {
                                                        id: {{ $site->id }},
                                                    }
                                                }
                                            })">
                                            voir
                                        </button>

                                        @if($site->lattitude > 0 && $site->longitude > 0)
                                            <button class="btn btn-sm btn-success"
                                                wire:key="map-{{ $site->id }}-{{ $activite->id }}-{{ $loop->index }}"
                                                wire:click="$dispatch('show-modal', { 
                                                    title: '{{ $site->nom }}', 
                                                    content: {
                                                        type: 'component',
                                                        name: 'map-modal',
                                                        key: 'map-{{ $site->id }}-{{ $activite->id }}-{{ $loop->index }}',
                                                        params: {
                                                            lat: {{ $site->lattitude }},
                                                            lng: {{ $site->longitude }},
                                                            title: '{{ $site->nom }}'
                                                        }
                                                    }
                                                })">
                                                Map
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="alert alert-info mt-4">
                <i class="bi bi-info-circle me-2"></i>
                Aucune activité n'est associée à cette composante.
            </div>
        @endif
    </div>
</div>

@push('styles')
<style>
    .activity-indicator {
        transition: height 0.2s ease;
    }
    .table tbody tr:hover .activity-indicator {
        height: 32px !important;
    }
</style>
@endpush