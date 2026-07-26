@props(['composante'])

<div class="composante-details">
    <!-- En-tête avec informations principales -->
    <div class="d-flex align-items-center mb-3">
        <div class="composante-icon me-3">
            <i class="bi bi-diagram-3 fs-5 text-primary"></i>
        </div>
        <div>
            <div class="d-flex align-items-center gap-2 mb-1">
                <h2 class="h3 mb-0">{{ $composante->code }}</h2>
                <span class="badge bg-info">Composante</span>
                @if($composante->projet)
                    <span class="badge bg-secondary">Projet: {{ $composante->projet->code }}</span>
                @endif
            </div>
            @if($composante->description)
                <p class="text-muted mb-0">{{ $composante->description }}</p>
            @endif
        </div>
    </div>

    <!-- Cartes de synthèse financière -->
    <div class="row g-3 mb-4">
        <!-- Budget total -->
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-light rounded-circle p-3">
                                <i class="bi bi-pie-chart fs-4 text-primary"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Budget total</h6>
                            <h3 class="mb-0">{{ number_format($composante->budget, 0, ',', ' ') }} $</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Montant décaissé -->
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-light rounded-circle p-3">
                                <i class="bi bi-cash-stack fs-4 text-success"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Montant décaissé</h6>
                            <h3 class="mb-0 text-success">{{ number_format($composante->decaisse, 0, ',', ' ') }} FCFA</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pourcentage d'exécution -->
        <div class="col-md-4">
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
                                $globalPercentage = $composante->projet && $composante->projet->budget > 0 
                                    ? ($composante->decaisse / $composante->projet->budget) * 100 
                                    : 0;
                            @endphp
                            <h3 class="mb-0 text-info">{{ number_format($globalPercentage, 1) }}%</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tableau des activités -->
    @if($composante->activites && $composante->activites->count() > 0)
        <div class="activities-section mt-4">
            <h5 class="mb-3">
                <i class="bi bi-list-task me-2"></i>
                Activités ({{ $composante->activites->count() }})
            </h5>
            
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th scope="col"> Activité</th>
                            <th scope="col" class="text-end">Budget</th>
                            <th scope="col" class="text-end">Décaissé</th>
                            <th scope="col" class="text-center" style="min-width: 150px;">Taux d'exécution</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($composante->activites as $index => $activite)
                            @php
                                $budget = $activite->budget ?? 0;
                                $decaisse = $activite->decaisse ?? 0;
                                $percentage = $budget > 0 ? round(($decaisse / $budget) * 
                    100, 1) : 0;
                                $progressClass = $percentage >= 100 ? 'bg-success' : ($percentage >= 70 ? 'bg-primary' : ($percentage >= 30 ? 'bg-warning' : 'bg-danger'));
                            @endphp
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="activity-indicator me-2" style="width: 4px; height: 24px; background-color: {{ $index % 2 ? '#ffc107' : '#0d6efd' }}; border-radius: 2px;"></span>
                                        <div>
                                            <strong>Activité {{ $index + 1 }}</strong>
                                            @if($activite->nom)
                                                <small class="text-muted d-block">{{ $activite->nom }}</small>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end fw-bold">{{ number_format($budget, 0, ',', ' ') }}</td>
                                <td class="text-end {{ $decaisse > $budget ? 'text-danger fw-bold' : '' }}">
                                    {{ number_format($decaisse, 0, ',', ' ') }}
                                    @if($decaisse > $budget)
                                        <i class="bi bi-exclamation-triangle-fill text-danger ms-1" title="Dépassement de budget"></i>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="fw-bold" style="min-width: 45px;">{{ $percentage }}%</span>
                                        <div class="progress flex-grow-1" style="height: 8px;">
                                            <div class="progress-bar {{ $progressClass }}" 
                                                 role="progressbar" 
                                                 style="width: {{ min($percentage, 100) }}%;" 
                                                 aria-valuenow="{{ $percentage }}" 
                                                 aria-valuemin="0" 
                                                 aria-valuemax="100">
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    @if($composante->activites->count() > 1)
                        <tfoot class="table-light">
                            <tr>
                                <th>Total</th>
                                <th class="text-end">{{ number_format($composante->activites->sum('budget'), 0, ',', ' ') }}</th>
                                <th class="text-end">{{ number_format($composante->activites->sum('decaisse'), 0, ',', ' ') }}</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    @endif
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