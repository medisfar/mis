<div>
    <h5>Activités et projets contributeurs</h5>
    <div class="table-responsive mb-4">
        <table class="table table-sm table-bordered table-striped mb-0">
            <thead class="thead-dark">
                <tr>
                    <th>Projet</th>
                    <th>Activité</th>
                    <th class="text-right">Budget activité</th>
                    <th class="text-right">Réalisé</th>
                    <th class="text-right">Coût affecté</th>
                    <th>Commentaire</th>
                </tr>
            </thead>
            <tbody>
            @forelse($contributions as $contribution)
                <tr>
                    <td>{{ $contribution->activite?->composante?->projet?->libelle ?? 'Null' }}</td>
                    <td>{{ $contribution->activite?->activite ?? 'Null' }}</td>
                    <td class="text-right">{{ number_format((float)($contribution->activite?->budget ?? 0), 0, ',', ' ') }}</td>
                    <td class="text-right">{{ number_format((float)$contribution->indicateur_realise, 2, ',', ' ') }} {{ $contribution->unite }}</td>
                    <td class="text-right">{{ number_format((float)$contribution->cout, 0, ',', ' ') }}</td>
                    <td>{{ $contribution->commentaire ?: 'Null' }}</td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center text-muted">Aucune contribution valide.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <h5>Sites d’exécution et tâches</h5>
    @forelse($activites as $activite)
        <div class="card card-outline card-success mb-3">
            <div class="card-header py-2">
                <strong>{{ $activite->activite }}</strong>
                <span class="text-muted">— {{ $activite->composante?->projet?->libelle ?? 'Projet inconnu' }}</span>
            </div>
            <div class="card-body p-0 table-responsive">
                <table class="table table-sm table-bordered table-striped mb-0">
                    <thead>
                        <tr>
                            <th>Site</th>
                            <th>Localité du site</th>
                            <th>Tâche réalisée</th>
                            <th class="text-right">Budget tâche</th>
                            <th>Période</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($activite->sites->unique('id') as $site)
                        @php $siteTaches = $activite->taches->where('site_id', $site->id); @endphp
                        @if($siteTaches->isEmpty())
                            <tr>
                                <td>{{ $site->nom ?: 'Null' }}</td>
                                <td>{{ $site->localite?->nom_localite ?? 'Null' }}</td>
                                <td>Null</td>
                                <td class="text-right">0</td>
                                <td>Null</td>
                            </tr>
                        @else
                            @foreach($siteTaches as $tache)
                                <tr>
                                    <td>{{ $site->nom ?: 'Null' }}</td>
                                    <td>{{ $site->localite?->nom_localite ?? 'Null' }}</td>
                                    <td>{{ $tache->tache }}</td>
                                    <td class="text-right">{{ number_format((float)$tache->budget, 0, ',', ' ') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($tache->date_debut)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($tache->date_fin)->format('d/m/Y') }}</td>
                                </tr>
                            @endforeach
                        @endif
                    @empty
                        <tr><td colspan="5" class="text-center text-muted">Aucun site n’est affecté à cette activité.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @empty
        <div class="alert alert-info">Aucune activité contributrice.</div>
    @endforelse
</div>
