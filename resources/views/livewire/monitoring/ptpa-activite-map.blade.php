<div>
    <div class="mb-3">
        <small class="text-muted text-uppercase font-weight-bold">Sites de l’activité</small>
        <h5 class="mb-0">{{ $activite->activite }}</h5>
    </div>

    <div class="row mb-3">
        <div class="col-md-4 mb-2">
            <div class="border rounded bg-light p-3 h-100">
                <small class="text-muted d-block">Sites rattachés</small>
                <strong class="h4 mb-0">{{ $sites->count() }}</strong>
            </div>
        </div>
        <div class="col-md-4 mb-2">
            <div class="border rounded bg-light p-3 h-100">
                <small class="text-muted d-block">Cartographiés</small>
                <strong class="h4 text-success mb-0">{{ $mappedSites->count() }}</strong>
            </div>
        </div>
        <div class="col-md-4 mb-2">
            <div class="border rounded bg-light p-3 h-100">
                <small class="text-muted d-block">GPS manquant</small>
                <strong class="h4 text-secondary mb-0">{{ $missingSites->count() }}</strong>
            </div>
        </div>
    </div>

    @if($mappedSites->isNotEmpty())
        <div class="border rounded overflow-hidden bg-light" style="height: 480px;">
            <iframe
                title="Carte des sites de l’activité"
                src="{{ $mapUrl }}"
                style="width: 100%; height: 100%; border: 0;"
                loading="lazy"
            ></iframe>
        </div>
    @else
        <div class="alert alert-warning mb-3">
            Aucun site rattaché à cette activité ne possède de coordonnées GPS valides.
        </div>
    @endif

    @if($missingSites->isNotEmpty())
        <div class="mt-3">
            <strong>Sites sans coordonnées GPS</strong>
            <div class="d-flex flex-wrap mt-2" style="gap: 7px;">
                @foreach($missingSites as $site)
                    <span class="badge badge-secondary p-2">{{ $site->nom }}</span>
                @endforeach
            </div>
        </div>
    @endif
</div>
