<div>
    <x-slot name="titre">Objectifs — Réalisations</x-slot>
    <x-slot name="stitre">@include('livewire.monitoring.menu')</x-slot>

    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Produits et livrables réalisés</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-xl-3 col-md-6">
                    <label>Recherche</label>
                    <input class="form-control" placeholder="Produit, résultat, mission, projet, activité…" wire:model.live.debounce.400ms="search">
                </div>
                <div class="form-group col-xl-2 col-md-6">
                    <label>Mission</label>
                    <select class="form-control" wire:model.live="mission_id">
                        <option value="">Toutes</option>
                        @foreach($missions as $mission)<option value="{{ $mission->id }}">{{ $mission->libelle }}</option>@endforeach
                    </select>
                </div>
                <div class="form-group col-xl-2 col-md-6">
                    <label>Résultat</label>
                    <select class="form-control" wire:model.live="resultat_id">
                        <option value="">Tous</option>
                        @foreach($resultats as $resultat)<option value="{{ $resultat->id }}">{{ $resultat->description }}</option>@endforeach
                    </select>
                </div>
                <div class="form-group col-xl-2 col-md-6">
                    <label>ODD</label>
                    <select class="form-control" wire:model.live="odd_id">
                        <option value="">Tous</option>
                        @foreach($odds as $odd)<option value="{{ $odd->id }}">{{ $odd->nom }}</option>@endforeach
                    </select>
                </div>
                <div class="form-group col-xl-2 col-md-6">
                    <label>Projet</label>
                    <select class="form-control" wire:model.live="projet_id">
                        <option value="">Tous</option>
                        @foreach($projets as $projet)<option value="{{ $projet->id }}">{{ $projet->libelle }}</option>@endforeach
                    </select>
                </div>
                <div class="form-group col-xl-1 col-md-6">
                    <label>Année</label>
                    <select class="form-control" wire:model.live="periode">
                        <option value="">Toutes</option>
                        @foreach($periodes as $item)<option value="{{ $item->valeur }}">{{ $item->libelle }}</option>@endforeach
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-xl-3 col-md-6">
                    <label>Région</label>
                    <select class="form-control" wire:model.live="region_id">
                        <option value="">Toutes</option>
                        @foreach($regions as $region)<option value="{{ $region->id }}">{{ $region->nom_region }}</option>@endforeach
                    </select>
                </div>
                <div class="form-group col-xl-3 col-md-6">
                    <label>Préfecture</label>
                    <select class="form-control" wire:model.live="prefecture_id">
                        <option value="">Toutes</option>
                        @foreach($prefectures as $prefecture)<option value="{{ $prefecture->id }}">{{ $prefecture->nom_prefecture }}</option>@endforeach
                    </select>
                </div>
                <div class="form-group col-xl-3 col-md-6">
                    <label>Sous-préfecture</label>
                    <select class="form-control" wire:model.live="ssprefecture_id">
                        <option value="">Toutes</option>
                        @foreach($ssprefectures as $ssp)<option value="{{ $ssp->id }}">{{ $ssp->nom_ssprefecture }}</option>@endforeach
                    </select>
                </div>
                <div class="form-group col-xl-3 col-md-6">
                    <label>Localité</label>
                    <select class="form-control" wire:model.live="localite_id">
                        <option value="">Toutes</option>
                        @foreach($localites as $localite)<option value="{{ $localite->id }}">{{ $localite->nom_localite }}</option>@endforeach
                    </select>
                </div>
            </div>

            <button class="btn btn-sm btn-secondary mb-3" wire:click="resetFilters">
                <i class="fas fa-undo"></i> Réinitialiser les filtres
            </button>

            <div class="row">
                <div class="col-xl col-md-4 col-6">
                    <div class="small-box bg-info"><div class="inner"><h3>{{ $nombreProduits }}</h3><p>Produits réalisés</p></div><div class="icon"><i class="fas fa-box-open"></i></div></div>
                </div>
                <div class="col-xl col-md-4 col-6">
                    <div class="small-box bg-success"><div class="inner"><h3>{{ number_format($totalCout, 0, ',', ' ') }}</h3><p>Investissement total</p></div><div class="icon"><i class="fas fa-coins"></i></div></div>
                </div>
                <div class="col-xl col-md-4 col-6">
                    <div class="small-box bg-warning"><div class="inner"><h3>{{ $nombreProjets }}</h3><p>Projets contributeurs</p></div><div class="icon"><i class="fas fa-project-diagram"></i></div></div>
                </div>
                <div class="col-xl col-md-4 col-6">
                    <div class="small-box bg-primary"><div class="inner"><h3>{{ $nombreResultats }}</h3><p>Résultats soutenus</p></div><div class="icon"><i class="fas fa-bullseye"></i></div></div>
                </div>
                <div class="col-xl col-md-4 col-6">
                    <div class="small-box bg-secondary"><div class="inner"><h3>{{ $nombreMissions }}</h3><p>Missions soutenues</p></div><div class="icon"><i class="fas fa-flag"></i></div></div>
                </div>
            </div>

            <div class="alert alert-light border">
                Cliquez sur la case d’une mission pour afficher ses résultats, ses ODD et ses produits.
                Les chiffres sont recalculés selon les filtres actifs.
            </div>

            @forelse($missionsHierarchy as $missionBloc)
                @php
                    $mission = $missionBloc->mission;
                    $stats = $missionBloc->statistiques;
                    $isOpen = in_array($mission->id, $openMissions, true);
                @endphp
                <div class="card mb-4 border-danger" wire:key="mission-objectifs-{{ $mission->id }}">
                    <div class="card-header bg-light p-3" style="border-top: 7px solid #dc3545;">
                        <div class="row align-items-center">
                            <div class="col-xl-5 mb-2 mb-xl-0">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox"
                                        class="custom-control-input"
                                        id="mission-check-{{ $mission->id }}"
                                        @checked($isOpen)
                                        wire:click="toggleMission({{ $mission->id }})">
                                    <label class="custom-control-label h5 mb-0 text-primary" for="mission-check-{{ $mission->id }}">
                                        {{ $mission->libelle }}
                                    </label>
                                </div>
                                @if($mission->description)
                                    <small class="text-muted d-block ml-4 mt-1">{{ $mission->description }}</small>
                                @endif
                            </div>
                            <div class="col-xl-7">
                                <div class="row text-center">
                                    <div class="col"><small class="text-muted d-block">Produits</small><strong>{{ $stats['produits'] }}</strong></div>
                                    <div class="col"><small class="text-muted d-block">Projets</small><strong>{{ $stats['projets'] }}</strong></div>
                                    <div class="col"><small class="text-muted d-block">Activités</small><strong>{{ $stats['activites'] }}</strong></div>
                                    <div class="col"><small class="text-muted d-block">Sous-préfectures</small><strong>{{ $stats['ssprefectures'] }}</strong></div>
                                    <div class="col"><small class="text-muted d-block">Localités</small><strong>{{ $stats['localites'] }}</strong></div>
                                    <div class="col-3"><small class="text-muted d-block">Investissement</small><strong>{{ number_format((float)$stats['cout'], 0, ',', ' ') }}</strong></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($isOpen)
                        <div class="card-body bg-white">
                            @foreach($missionBloc->resultats as $resultatBloc)
                                @php
                                    $resultat = $resultatBloc->resultat;
                                    $resultatStats = $resultatBloc->statistiques;
                                    $isResultatOpen = in_array($resultat->id, $openResultats, true);
                                @endphp
                                <div class="card card-outline card-secondary ml-xl-4 mb-4" wire:key="resultat-objectifs-{{ $resultat->id }}">
                                    <div class="card-header">
                                        <div class="row align-items-center">
                                            <div class="col-xl-6">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox"
                                                        class="custom-control-input"
                                                        id="resultat-check-{{ $resultat->id }}"
                                                        @checked($isResultatOpen)
                                                        wire:click="toggleResultat({{ $resultat->id }})">
                                                    <label class="custom-control-label font-weight-bold" for="resultat-check-{{ $resultat->id }}">
                                                        {{ $resultat->description }}
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="row text-center">
                                                    <div class="col"><small class="text-muted d-block">Produits</small><strong>{{ $resultatStats['produits'] }}</strong></div>
                                                    <div class="col"><small class="text-muted d-block">Projets</small><strong>{{ $resultatStats['projets'] }}</strong></div>
                                                    <div class="col"><small class="text-muted d-block">Activités</small><strong>{{ $resultatStats['activites'] }}</strong></div>
                                                    <div class="col"><small class="text-muted d-block">Zones</small><strong>{{ $resultatStats['ssprefectures'] + $resultatStats['localites'] }}</strong></div>
                                                    <div class="col-4"><small class="text-muted d-block">Investissement</small><strong>{{ number_format((float)$resultatStats['cout'], 0, ',', ' ') }}</strong></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if($isResultatOpen)
                                    <div class="card-body" style="background: #fffde7;">
                                        <div class="mb-3">
                                            <strong>ODD alignés :</strong>
                                            @forelse($resultat->odds as $odd)
                                                <span class="badge badge-warning p-2">{{ $odd->nom }}</span>
                                            @empty
                                                <span class="text-muted">Null</span>
                                            @endforelse
                                        </div>

                                        <div class="table-responsive">
                                            <table class="table table-sm table-bordered table-striped bg-white mb-0">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th>Produit</th>
                                                        <th>Année</th>
                                                        <th>Sous-préfecture</th>
                                                        <th>Localité</th>
                                                        <th class="text-right">Réalisé</th>
                                                        <th class="text-right">Coût</th>
                                                        <th class="text-center">Contributions</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @forelse($resultatBloc->produits as $groupe)
                                                    <tr wire:key="produit-groupe-{{ md5($groupe->key) }}">
                                                        <td>{{ $groupe->produit?->description }}</td>
                                                        <td>{{ $groupe->periode }}</td>
                                                        <td>{{ $groupe->ssprefecture?->nom_ssprefecture ?? 'Null' }}</td>
                                                        <td>{{ $groupe->localite?->nom_localite ?? 'Null' }}</td>
                                                        <td class="text-right"><strong>{{ number_format((float)$groupe->indicateur_realise, 2, ',', ' ') }}</strong> {{ $groupe->unite }}</td>
                                                        <td class="text-right">{{ number_format((float)$groupe->cout, 0, ',', ' ') }}</td>
                                                        <td class="text-center">{{ $groupe->nombre_activites }} activité(s)<br><small>{{ $groupe->nombre_projets }} projet(s)</small></td>
                                                        <td>
                                                            <button
                                                                type="button"
                                                                class="btn btn-xs btn-primary"
                                                                wire:click="$dispatch('show-modal', {
                                                                    title: 'Détail des contributions',
                                                                    size: 'modal-xl',
                                                                    content: {
                                                                        type: 'component',
                                                                        name: 'monitoring.objectif-produit-detail',
                                                                        key: 'objectif-produit-{{ md5($groupe->key) }}',
                                                                        params: { contributionIds: @js($groupe->contributions->pluck('id')->values()->all()) }
                                                                    }
                                                                })"
                                                            ><i class="fas fa-eye"></i> Voir</button>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="8" class="text-center text-muted py-3">
                                                            Aucun produit réalisé pour ce résultat.
                                                        </td>
                                                    </tr>
                                                @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            @empty
                <div class="alert alert-info text-center">Aucune mission ne contient de réalisation valide correspondant aux filtres.</div>
            @endforelse
        </div>
    </div>

</div>
