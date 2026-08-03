<div class="p-3 indicateur-outil">
    <style>
        .indicateur-outil .table-responsive {
            padding-bottom: 8px;
        }

        .indicateur-outil .indicator-table {
            min-width: 1320px;
            border-collapse: separate;
            border-spacing: 0 7px;
        }

        .indicateur-outil .indicator-table thead th {
            padding: 14px 12px;
            vertical-align: middle;
            white-space: nowrap;
            border-color: #2f3740;
        }

        .indicateur-outil .indicator-table tbody td {
            padding: 13px 12px;
            vertical-align: top;
            line-height: 1.55;
            border-color: #d8edf0;
            background: #d5f2f5;
        }

        .indicateur-outil .indicator-table tbody tr:nth-child(even) td {
            background: #c6e9ed;
        }

        .indicateur-outil .indicator-table .col-indicateur {
            min-width: 520px;
        }

        .indicateur-outil .indicator-table .col-unite {
            min-width: 120px;
        }

        .indicateur-outil .indicator-table .col-frequence,
        .indicateur-outil .indicator-table .col-niveau,
        .indicateur-outil .indicator-table .col-source,
        .indicateur-outil .indicator-table .col-periode {
            min-width: 120px;
        }

        .indicateur-outil .indicator-table .col-valeur {
            min-width: 95px;
        }

        .indicateur-outil .indicator-table .col-action {
            min-width: 170px;
        }

        .indicateur-outil .indicator-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }

        .indicateur-outil .niveau-select {
            border-color: #8b5cf6;
            background: #f3e8ff;
            color: #4c1d95;
            font-weight: 600;
        }

        .indicateur-outil .periode-input {
            border-color: #f59e0b;
            background: #fff7d6;
            color: #7c2d12;
            font-weight: 600;
        }

        .indicateur-outil .niveau-badge,
        .indicateur-outil .periode-badge {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 6px;
            font-weight: 700;
            white-space: nowrap;
        }

        .indicateur-outil .niveau-badge {
            color: #ffffff;
            background: #7c3aed;
        }

        .indicateur-outil .periode-badge {
            color: #1f2937;
            background: #facc15;
        }

        .indicateur-outil .realisation-value,
        .indicateur-outil .status-badge {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 999px;
            font-weight: 800;
            white-space: nowrap;
        }

        .indicateur-outil .realisation-value {
            min-width: 58px;
            color: #123b67;
            background: #e1eff8;
            text-align: center;
        }

        .indicateur-outil .status-achieved { color: #fff; background: #18864b; }
        .indicateur-outil .status-on-track { color: #185c37; background: #c9f2d8; }
        .indicateur-outil .status-at-risk { color: #a31322; background: #ffd7dc; }
        .indicateur-outil .status-unreported { color: #5f6873; background: #e6e9ed; }

        .indicateur-outil .values-modal-backdrop {
            position: fixed;
            inset: 0;
            z-index: 1060;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            background: rgba(7, 24, 43, .68);
            backdrop-filter: blur(3px);
        }

        .indicateur-outil .values-modal {
            width: min(1050px, 96vw);
            max-height: 92vh;
            overflow: hidden;
            border-radius: 16px;
            background: #f7fafc;
            box-shadow: 0 24px 70px rgba(0, 0, 0, .32);
        }

        .indicateur-outil .values-modal-header {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            padding: 22px 26px;
            color: #fff;
            background: linear-gradient(135deg, #123b67, #1f6f78);
        }

        .indicateur-outil .values-modal-header h4 {
            margin: 3px 0 0;
            font-size: 20px;
            line-height: 1.35;
        }

        .indicateur-outil .values-modal-header small {
            color: #bfe8ef;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .05em;
        }

        .indicateur-outil .values-modal-close {
            align-self: flex-start;
            border: 0;
            border-radius: 50%;
            width: 36px;
            height: 36px;
            color: #fff;
            background: rgba(255, 255, 255, .16);
            font-size: 24px;
            line-height: 1;
        }

        .indicateur-outil .values-modal-body {
            max-height: calc(92vh - 105px);
            overflow-y: auto;
            padding: 22px 26px 26px;
        }

        .indicateur-outil .values-summary {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            margin-bottom: 18px;
        }

        .indicateur-outil .values-summary > div {
            border: 1px solid #dce7ee;
            border-radius: 10px;
            padding: 11px 14px;
            background: #fff;
        }

        .indicateur-outil .values-summary span {
            display: block;
            color: #708090;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .indicateur-outil .values-entry-card {
            border: 1px solid #cfe1e8;
            border-left: 5px solid #1f9d70;
            border-radius: 10px;
            padding: 16px;
            margin-bottom: 18px;
            background: #fff;
        }

        .indicateur-outil .unit-addon {
            min-width: 105px;
            justify-content: center;
            font-weight: 700;
        }

        .indicateur-outil .values-table td,
        .indicateur-outil .values-table th {
            vertical-align: middle;
        }

        @media (max-width: 767px) {
            .indicateur-outil .values-modal-backdrop { padding: 8px; }
            .indicateur-outil .values-modal-header,
            .indicateur-outil .values-modal-body { padding: 16px; }
            .indicateur-outil .values-summary { grid-template-columns: 1fr; }
        }
    </style>

    @include('livewire.errors')

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
        <div>
            <h5 class="mb-1">{{ $lectureSeule ? 'Suivi des indicateurs' : 'Gestion des indicateurs' }}</h5>
            <small class="text-muted">
                Cadre de resultat - sources et valeurs de suivi
                @if($projet)
                    | Projet : <strong>{{ $projet->libelle }}</strong>
                @endif
            </small>
        </div>
        @unless($lectureSeule)
            <button class="btn btn-sm btn-success" wire:click="create">
                <i class="fas fa-plus"></i> Ajouter un indicateur
            </button>
        @endunless
    </div>

    @if(!$lectureSeule && $showForm)
        <div class="card mb-3">
            <div class="card-header bg-light">
                <strong>{{ $editingId ? 'Modifier un indicateur' : 'Nouvel indicateur' }}</strong>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-12">
                        <label>Indicateur</label>
                        <input type="text" class="form-control" wire:model.lazy="nom">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Unite de mesure</label>
                        <input type="text" class="form-control" wire:model.lazy="unite_mesure" placeholder="Nombre, Pourcentage...">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Frequence</label>
                        <select class="form-control" wire:model.live="frequence">
                            <option value=""></option>
                            @foreach($frequences as $key => $label)
                                <option value="{{ $key }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Niveau</label>
                        <select class="form-control niveau-select" wire:model.live="niveau">
                            <option value=""></option>
                            @foreach($niveaux as $key => $label)
                                <option value="{{ $key }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Source</label>
                        <select class="form-control" wire:model.live="source">
                            <option value=""></option>
                            @foreach($sources as $key => $label)
                                <option value="{{ $key }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label>Baseline</label>
                        <input type="number" step="0.01" class="form-control" wire:model.lazy="baseline">
                    </div>

                    <div class="form-group col-md-2">
                        <label>Valeur cible</label>
                        <input type="number" step="0.01" class="form-control" wire:model.lazy="valeur_cible">
                    </div>

                    <div class="form-group col-md-2">
                        <label>Periode</label>
                        <input type="text" class="form-control periode-input" wire:model.lazy="periode" placeholder="2025, T1 2025...">
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button class="btn btn-sm btn-secondary mr-2" wire:click="cancel">Annuler</button>
                    <button class="btn btn-sm btn-primary" wire:click="save">
                        <i class="fas fa-save"></i> Enregistrer
                    </button>
                </div>
            </div>
        </div>
    @endif

    @error('projet')
        <div class="alert alert-warning">{{ $message }}</div>
    @enderror

    @if(!$projet)
        <div class="alert alert-warning">
            Veuillez choisir un projet pour afficher ou saisir ses indicateurs.
        </div>
    @endif

    @if($detail)
        <div class="alert alert-info">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <strong>{{ $detail->nom }}</strong><br>
                    <span>Source : {{ $detail->source_libelle ?: '-' }}</span> |
                    <span>Niveau : {{ $detail->niveau_libelle ?: '-' }}</span> |
                    <span>Periode : {{ $detail->periode ?: '-' }}</span><br>
                    <span>Baseline : {{ $detail->baseline ?? '-' }}</span> |
                    <span>Cible : {{ $detail->valeur_cible ?? '-' }}</span>
                </div>
                <button type="button" class="close" wire:click="hideDetail">
                    <span>&times;</span>
                </button>
            </div>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-2">
        <input type="text" class="form-control form-control-sm col-md-4" wire:model.live="search" placeholder="Rechercher un indicateur, une source ou un niveau">
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-sm indicator-table">
            <thead class="thead-dark">
                <tr>
                    <th class="col-indicateur">Indicateur</th>
                    <th class="col-unite">Unité de mesure</th>
                    <th class="col-frequence">Fréquence</th>
                    <th class="col-niveau">Niveau</th>
                    <th class="col-source">Source</th>
                    <th class="col-valeur">Baseline</th>
                    <th class="col-valeur">Valeur cible</th>
                    <th class="col-periode">Période</th>
                    @if($lectureSeule)
                        <th class="col-valeur">Réalisation</th>
                        <th class="col-statut">Statut</th>
                    @endif
                    <th class="col-action">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($indicateurs as $item)
                    <tr>
                        <td>{{ $item->nom }}</td>
                        <td>{{ $item->unite_mesure ?: '-' }}</td>
                        <td>{{ $item->frequence_libelle ?: '-' }}</td>
                        <td>
                            @if($item->niveau !== null && $item->niveau !== '')
                                <span class="niveau-badge">{{ $item->niveau_libelle }}</span>
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $item->source_libelle ?: '-' }}</td>
                        <td>{{ $item->baseline ?? '-' }}</td>
                        <td>{{ $item->valeur_cible ?? '-' }}</td>
                        <td>
                            @if($item->periode)
                                <span class="periode-badge">{{ $item->periode }}</span>
                            @else
                                -
                            @endif
                        </td>
                        @if($lectureSeule)
                            <td>
                                @if($item->realisation !== null)
                                    <span class="realisation-value">{{ $item->realisation }}%</span>
                                @else
                                    <span class="text-muted">Non calculable</span>
                                @endif
                            </td>
                            <td>
                                <span class="status-badge {{ $item->statut_suivi['classe'] }}">
                                    {{ $item->statut_suivi['libelle'] }}
                                </span>
                            </td>
                        @endif
                        <td>
                            <div class="indicator-actions">
                                <button class="btn btn-sm btn-info" wire:click="openValues({{ $item->id }})">
                                    <i class="fas fa-list-alt"></i> {{ $lectureSeule ? 'Voir detail' : 'Saisie detail' }}
                                </button>
                                @unless($lectureSeule)
                                    <button class="btn btn-sm btn-primary" wire:click="edit({{ $item->id }})"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-sm btn-danger" wire:confirm="Etes-vous sur de vouloir supprimer cet indicateur ?" wire:click="delete({{ $item->id }})"><i class="fas fa-trash"></i></button>
                                @endunless
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ $lectureSeule ? 11 : 8 }}" class="text-center text-muted">Aucun indicateur saisi pour le moment.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $indicateurs->links() }}

    @if($showValuesModal && $valuesIndicator)
        <div class="values-modal-backdrop" wire:click.self="closeValues">
            <section class="values-modal" role="dialog" aria-modal="true" aria-labelledby="values-modal-title">
                <header class="values-modal-header">
                    <div>
                        <small>{{ $lectureSeule ? 'Suivi des valeurs intermediaires' : 'Saisie des valeurs intermediaires' }}</small>
                        <h4 id="values-modal-title">{{ $valuesIndicator->nom }}</h4>
                    </div>
                    <button type="button" class="values-modal-close" wire:click="closeValues" aria-label="Fermer">&times;</button>
                </header>

                <div class="values-modal-body">
                    <div class="values-summary">
                        <div><span>Projet</span><strong>{{ $valuesIndicator->projet->libelle ?? '-' }}</strong></div>
                        <div><span>Frequence</span><strong>{{ $valuesIndicator->frequence_libelle ?: '-' }}</strong></div>
                        <div><span>Unite de mesure</span><strong>{{ $valuesIndicator->unite_mesure ?: '-' }}</strong></div>
                    </div>

                    @unless($lectureSeule)
                        <form wire:submit="saveValue" class="values-entry-card">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <strong>{{ $editingValueId ? 'Modifier la saisie' : 'Nouvelle saisie' }}</strong>
                                @if($editingValueId)
                                    <button type="button" class="btn btn-sm btn-outline-secondary" wire:click="cancelValueEdit">Annuler la modification</button>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="value-period">Periode de collecte</label>
                                    <select id="value-period" class="form-control @error('valuePeriod') is-invalid @enderror" wire:model="valuePeriod">
                                        <option value="">Choisir une periode</option>
                                        @if($valuePeriod && !in_array($valuePeriod, $periodOptions, true))
                                            <option value="{{ $valuePeriod }}">{{ $valuePeriod }}</option>
                                        @endif
                                        @foreach($periodOptions as $periodOption)
                                            <option value="{{ $periodOption }}">{{ $periodOption }}</option>
                                        @endforeach
                                    </select>
                                    @error('valuePeriod') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="value-target">Valeur cible</label>
                                    <div class="input-group">
                                        <input id="value-target" type="number" min="0" step="any" class="form-control @error('valueTarget') is-invalid @enderror" wire:model="valueTarget">
                                        <div class="input-group-append"><span class="input-group-text unit-addon">{{ $valuesIndicator->unite_mesure ?: 'Unite' }}</span></div>
                                        @error('valueTarget') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="value-realized">Valeur realisee</label>
                                    <div class="input-group">
                                        <input id="value-realized" type="number" min="0" step="any" class="form-control @error('valueRealized') is-invalid @enderror" wire:model="valueRealized">
                                        <div class="input-group-append"><span class="input-group-text unit-addon">{{ $valuesIndicator->unite_mesure ?: 'Unite' }}</span></div>
                                        @error('valueRealized') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i> {{ $editingValueId ? 'Mettre a jour' : 'Enregistrer la valeur' }}
                            </button>
                        </form>
                    @endunless

                    <div class="table-responsive">
                        <table class="table table-hover table-bordered values-table bg-white mb-0">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Periode</th>
                                    <th class="text-right">Valeur cible</th>
                                    <th class="text-right">Valeur realisee</th>
                                    <th class="text-center">Taux</th>
                                    @unless($lectureSeule)<th class="text-center">Actions</th>@endunless
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($periodicValues as $periodicValue)
                                    @php
                                        $rate = $periodicValue->valeur_cible > 0
                                            ? round(($periodicValue->valeur / $periodicValue->valeur_cible) * 100)
                                            : null;
                                    @endphp
                                    <tr>
                                        <td><span class="periode-badge">{{ $periodicValue->periode }}</span></td>
                                        <td class="text-right font-weight-bold">{{ number_format((int) $periodicValue->valeur_cible, 0, ',', ' ') }} {{ $valuesIndicator->unite_mesure }}</td>
                                        <td class="text-right font-weight-bold">{{ number_format((int) $periodicValue->valeur, 0, ',', ' ') }} {{ $valuesIndicator->unite_mesure }}</td>
                                        <td class="text-center">
                                            @if($rate !== null)
                                                <span class="badge {{ $rate >= 100 ? 'badge-success' : ($rate >= 75 ? 'badge-info' : 'badge-warning') }} p-2">{{ $rate }}%</span>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        @unless($lectureSeule)
                                            <td class="text-center text-nowrap">
                                                <button type="button" class="btn btn-sm btn-primary" wire:click="editValue({{ $periodicValue->id }})"><i class="fas fa-edit"></i></button>
                                                <button type="button" class="btn btn-sm btn-danger" wire:confirm="Supprimer cette valeur periodique ?" wire:click="deleteValue({{ $periodicValue->id }})"><i class="fas fa-trash"></i></button>
                                            </td>
                                        @endunless
                                    </tr>
                                @empty
                                    <tr><td colspan="5" class="text-center text-muted py-4">Aucune valeur periodique saisie.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    @endif
</div>
