<div>
    <x-slot name="titre">Objectifs — Saisie</x-slot>
    <x-slot name="stitre">@include('livewire.geolocalisation.menu')</x-slot>

    <div class="card">
        <div class="card-header p-2">
            <ul class="nav nav-pills">
                @foreach([
                    'missions' => 'Missions',
                    'odds' => 'ODD',
                    'resultats' => 'Résultats',
                    'produits' => 'Produits et contributions',
                ] as $tab => $label)
                    <li class="nav-item">
                        <button type="button"
                            class="nav-link {{ $activeTab === $tab ? 'active' : '' }}"
                            wire:click="setTab('{{ $tab }}')">
                            {{ $label }}
                        </button>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="card-body">
            @if(session()->has('objectifs_message'))
                <div class="alert alert-success">{{ session('objectifs_message') }}</div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                    </ul>
                </div>
            @endif

            @if($activeTab === 'missions')
                <div class="row">
                    <div class="col-lg-4">
                        <h5>{{ $editingId ? 'Modifier la mission' : 'Nouvelle mission' }}</h5>
                        <div class="form-group">
                            <label>Libellé</label>
                            <input class="form-control" wire:model="libelle">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" rows="5" wire:model="description"></textarea>
                        </div>
                        <button class="btn btn-primary" wire:click="saveMission">Enregistrer</button>
                        <button class="btn btn-secondary" wire:click="resetEditor">Annuler</button>
                    </div>
                    <div class="col-lg-8 table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead><tr><th>Mission</th><th>Description</th><th>Résultats</th><th></th></tr></thead>
                            <tbody>
                            @foreach($missions as $mission)
                                <tr wire:key="mission-{{ $mission->id }}">
                                    <td>{{ $mission->libelle }}</td>
                                    <td>{{ $mission->description }}</td>
                                    <td>{{ $mission->resultats_count }}</td>
                                    <td><button class="btn btn-sm btn-primary" wire:click="editMission({{ $mission->id }})"><i class="fas fa-edit"></i></button></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @elseif($activeTab === 'odds')
                <div class="row">
                    <div class="col-lg-4">
                        <h5>{{ $editingId ? 'Modifier l’ODD' : 'Nouvel ODD' }}</h5>
                        <div class="form-group">
                            <label>Nom de l’ODD</label>
                            <input class="form-control" wire:model="libelle">
                        </div>
                        <button class="btn btn-primary" wire:click="saveOdd">Enregistrer</button>
                        <button class="btn btn-secondary" wire:click="resetEditor">Annuler</button>
                    </div>
                    <div class="col-lg-8 table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead><tr><th>ODD</th><th>Résultats alignés</th><th></th></tr></thead>
                            <tbody>
                            @foreach($odds as $odd)
                                <tr wire:key="odd-{{ $odd->id }}">
                                    <td>{{ $odd->nom }}</td>
                                    <td>{{ $odd->resultats_count }}</td>
                                    <td><button class="btn btn-sm btn-primary" wire:click="editOdd({{ $odd->id }})"><i class="fas fa-edit"></i></button></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @elseif($activeTab === 'resultats')
                <div class="row">
                    <div class="col-lg-4">
                        <h5>{{ $editingId ? 'Modifier le résultat' : 'Nouveau résultat' }}</h5>
                        <div class="form-group">
                            <label>Mission</label>
                            <select class="form-control" wire:model="mission_id">
                                <option value="">Sélectionner</option>
                                @foreach($missions as $mission)<option value="{{ $mission->id }}">{{ $mission->libelle }}</option>@endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Description du résultat</label>
                            <textarea class="form-control" rows="4" wire:model="description"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Alignement ODD</label>
                            <select class="form-control" multiple size="7" wire:model="odd_ids">
                                @foreach($odds as $odd)<option value="{{ $odd->id }}">{{ $odd->nom }}</option>@endforeach
                            </select>
                            <small class="text-muted">Maintenez Ctrl pour sélectionner plusieurs ODD.</small>
                        </div>
                        <button class="btn btn-primary" wire:click="saveResultat">Enregistrer</button>
                        <button class="btn btn-secondary" wire:click="resetEditor">Annuler</button>
                    </div>
                    <div class="col-lg-8 table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead><tr><th>Résultat</th><th>Mission</th><th>ODD</th><th>Produits</th><th></th></tr></thead>
                            <tbody>
                            @foreach($resultats as $resultat)
                                <tr wire:key="resultat-{{ $resultat->id }}">
                                    <td>{{ $resultat->description }}</td>
                                    <td>{{ $resultat->mission?->libelle }}</td>
                                    <td>
                                        @forelse($resultat->odds as $odd)
                                            <span class="badge badge-info">{{ $odd->nom }}</span>
                                        @empty
                                            <span class="text-muted">Aucun</span>
                                        @endforelse
                                    </td>
                                    <td>{{ $resultat->produits_count }}</td>
                                    <td><button class="btn btn-sm btn-primary" wire:click="editResultat({{ $resultat->id }})"><i class="fas fa-edit"></i></button></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <div class="row mb-4">
                    <div class="col-lg-4">
                        <h5>{{ $editingId ? 'Modifier le produit' : 'Nouveau produit' }}</h5>
                        <div class="form-group">
                            <label>Résultat attendu</label>
                            <select class="form-control" wire:model="resultat_id">
                                <option value="">Sélectionner</option>
                                @foreach($resultats as $resultat)
                                    <option value="{{ $resultat->id }}">{{ $resultat->mission?->libelle }} — {{ $resultat->description }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Description du produit/livrable</label>
                            <textarea class="form-control" rows="3" wire:model="description"></textarea>
                        </div>
                        <button class="btn btn-primary" wire:click="saveProduit">Enregistrer</button>
                        <button class="btn btn-secondary" wire:click="resetEditor">Annuler</button>
                    </div>

                    <div class="col-lg-8">
                        <h5>
                            {{ $contributionId ? 'Modifier la contribution' : 'Nouvelle contribution' }}
                            @if($contribution_produit_id)
                                — {{ $produits->firstWhere('id', $contribution_produit_id)?->description }}
                            @endif
                        </h5>
                        @if($contribution_produit_id)
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Activité contributrice</label>
                                    <select class="form-control" wire:model="activite_id">
                                        <option value="">Sélectionner</option>
                                        @foreach($activites as $activite)
                                            <option value="{{ $activite->id }}">
                                                {{ $activite->composante?->projet?->libelle }} — {{ $activite->activite }} (budget : {{ number_format($activite->budget, 0, ',', ' ') }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Sous-préfecture</label>
                                    <select class="form-control" wire:model.live="ssprefecture_id">
                                        <option value="">Sélectionner</option>
                                        @foreach(\App\Models\Ssprefecture::orderBy('nom_ssprefecture')->get() as $ssp)
                                            <option value="{{ $ssp->id }}">{{ $ssp->nom_ssprefecture }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Localité (facultatif)</label>
                                    <select class="form-control" wire:model="localite_id">
                                        <option value="">Null</option>
                                        @foreach(\App\Models\Localite::when($ssprefecture_id, fn($q) => $q->where('ssprefecture_id', $ssprefecture_id))->orderBy('nom_localite')->get() as $localite)
                                            <option value="{{ $localite->id }}">{{ $localite->nom_localite }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Réalisé</label>
                                    <input type="number" step="0.01" min="0" class="form-control" wire:model="indicateur_realise">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Unité</label>
                                    <input class="form-control" placeholder="Agriculteurs, km…" wire:model="unite">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Coût affecté</label>
                                    <input type="number" step="0.01" min="0" class="form-control" wire:model="cout">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Commentaire</label>
                                    <input class="form-control" wire:model="commentaire">
                                </div>
                            </div>
                            <button class="btn btn-success" wire:click="saveContribution">Enregistrer la contribution</button>
                            <button class="btn btn-secondary" wire:click="resetContribution">Annuler</button>
                        @else
                            <div class="alert alert-info">Utilisez « Ajouter une contribution » sur un produit.</div>
                        @endif
                    </div>
                </div>

                @foreach($produits as $produit)
                    <div class="card card-outline card-primary" wire:key="produit-{{ $produit->id }}">
                        <div class="card-header">
                            <strong>{{ $produit->description }}</strong>
                            <span class="text-muted">— {{ $produit->resultat?->description ?? 'Résultat à affecter' }}</span>
                            <div class="float-right">
                                <button class="btn btn-sm btn-primary" wire:click="editProduit({{ $produit->id }})"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-sm btn-success" wire:click="editContribution(null, {{ $produit->id }})">
                                    <i class="fas fa-plus"></i> Ajouter une contribution
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0 table-responsive">
                            <table class="table table-sm table-striped mb-0">
                                <thead><tr><th>Activité</th><th>Période</th><th>Sous-préfecture</th><th>Localité</th><th>Réalisé</th><th>Coût</th><th></th></tr></thead>
                                <tbody>
                                @forelse($produit->contributions as $contribution)
                                    <tr wire:key="contribution-{{ $contribution->id }}">
                                        <td>{{ $contribution->activite?->activite }}</td>
                                        <td>{{ $contribution->activite?->date_fin ? \Carbon\Carbon::parse($contribution->activite->date_fin)->format('m/Y') : 'Null' }}</td>
                                        <td>{{ $contribution->ssprefecture?->nom_ssprefecture ?? 'Null' }}</td>
                                        <td>{{ $contribution->localite?->nom_localite ?? 'Null' }}</td>
                                        <td>{{ number_format((float)$contribution->indicateur_realise, 2, ',', ' ') }} {{ $contribution->unite }}</td>
                                        <td>{{ number_format((float)$contribution->cout, 0, ',', ' ') }}</td>
                                        <td class="text-nowrap">
                                            <button class="btn btn-xs btn-primary" wire:click="editContribution({{ $contribution->id }})"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-xs btn-danger" wire:confirm="Supprimer cette contribution ?" wire:click="deleteContribution({{ $contribution->id }})"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="7" class="text-center text-muted">Aucune contribution saisie.</td></tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
