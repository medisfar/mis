@php
$missionId = $idm ?? 1;
$mission = \App\Models\Mission::find($missionId);
@endphp<div>
<div class="activite-details">
        <!-- En-tête avec informations principales -->
        <div class="d-flex align-items-center mb-3">
            <div class="activite-icon me-3">
                <i class="bi bi-diagram-3 fs-5 text-primary"></i>
            </div>
            <div>
                <div class="d-flex align-items-center gap-2 mb-1">
                    <h2 class="h3 mb-0"> {{ $mission->libelle??''}}</h2>
                </div>
              
                    <p class="mb-0"><strong>>{{ $mission->description??'' }}</strong></p>
             
            </div>
        </div>
@if($mission)
    <!-- Stats Cards -->
    <div class="row g-3 mb-4">
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
                            <h5 class="mb-0"></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                            <h6 class="text-muted mb-1">Engagé</h6>
                            <h5 class="mb-0"></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                            <h5 class="mb-0 text-success"></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                           
                            <h3 class="mb-0 text-info"></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table -->
    @if($mission->resultats->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Résultat</th>
                        <th>Secteur</th>
                       
                    </tr>
                </thead>
                <tbody>
                    @foreach($mission->resultats as $index => $resultat)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $resultat->description ?? 'Résultat' }}</td>
                            
                          
                               
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-success"
                                    wire:click="$dispatch('show-modal', { 
                                        title: '{{ addslashes($resultat->description ?? 'Résultat') }}', 
                                        content: {
                                            type: 'component',
                                            name: 'projet.resultats.resultat-show',
                                            params: { id: {{ $resultat->id }} }
                                        }
                                    })">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-info">
            Aucun résultat
        </div>
    @endif
@endif