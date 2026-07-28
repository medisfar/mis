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
    </style>

    @include('livewire.errors')

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
        <div>
            <h5 class="mb-1">Gestion des indicateurs</h5>
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
                        <label>Valeur actuelle</label>
                        <input type="number" step="0.01" class="form-control" wire:model.lazy="valeur_actuelle">
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
                    <span>Cible : {{ $detail->valeur_cible ?? '-' }}</span> |
                    <span>Actuelle : {{ $detail->valeur_actuelle ?? '-' }}</span>
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
                    <th class="col-unite">Unite de mesure</th>
                    <th class="col-frequence">Frequence</th>
                    <th class="col-niveau">Niveau</th>
                    <th class="col-source">Source</th>
                    <th class="col-valeur">Baseline</th>
                    <th class="col-valeur">Valeur cible</th>
                    <th class="col-valeur">Valeur actuelle</th>
                    <th class="col-periode">Periode</th>
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
                        <td>{{ $item->valeur_actuelle ?? '-' }}</td>
                        <td>
                            @if($item->periode)
                                <span class="periode-badge">{{ $item->periode }}</span>
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            <div class="indicator-actions">
                                <button class="btn btn-sm btn-info" wire:click="showDetail({{ $item->id }})">Voir detail</button>
                                @unless($lectureSeule)
                                    <button class="btn btn-sm btn-primary" wire:click="edit({{ $item->id }})"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-sm btn-danger" wire:confirm="Etes-vous sur de vouloir supprimer cet indicateur ?" wire:click="delete({{ $item->id }})"><i class="fas fa-trash"></i></button>
                                @endunless
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center text-muted">Aucun indicateur saisi pour le moment.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $indicateurs->links() }}
</div>
