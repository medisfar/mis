@php
    $resultat = \App\Models\Resultat::find($idm);
@endphp

<div>
    <div class="resultat-details">
        <!-- En-tête avec informations principales -->
        <div class="d-flex align-items-center mb-3">
            <div class="resultat-icon me-3">
                <i class="bi bi-diagram-3 fs-5 text-primary"></i>
            </div>
            <div>
                <div class="d-flex align-items-center gap-2 mb-1">
                    <h2 class="h3 mb-0">Resultat {{ $resultat->position}}</h2>
                </div>
                @if($resultat->description)
                    <p class="mb-0"><strong>>{{ $resultat->description }}</strong></p>
                @endif
            </div>
        </div>

        <!-- Tableau des activités -->
        @if($resultat && $resultat->produits->count() > 0)
            @php $percentage = 0; $progressClass = ''; @endphp
            <div class="activities-section mt-4">
                <h5 class="mb-3">
                    <i class="bi bi-list-task me-2"></i>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Produit</th>
                                <th>Budget</th>                               
                                <th>Periode</th>
                                <th>
                        
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($resultat->produits as $index => $p)
                                <tr wire:key="site-{{ $p->id }}-{{ $resultat->id }}-{{ $loop->index }}">
                                    <td>{{$p->description}}</td>
                                    <td class="text-end fw-bold">{{$p->budget}}</td>
                                    
                                    <td>
                                        
                                    
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
                Aucun produit n'est associée à cette composante.
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