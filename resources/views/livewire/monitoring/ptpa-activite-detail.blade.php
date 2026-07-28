<div>
    <div class="mb-3">
        <strong>{{ $activite->activite }}</strong>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped mb-0">
            <thead class="thead-dark">
                <tr>
                    <th>Site</th>
                    <th>Localité</th>
                    <th>Tâche</th>
                    <th>Budget</th>
                    <th>Période</th>
                    <th>Avancement</th>
                </tr>
            </thead>
            <tbody>
                @forelse($lignes as $ligne)
                    @php
                        $site = $ligne['site'];
                        $tache = $ligne['tache'];
                    @endphp
                    <tr>
                        <td>{{ $site->nom ?: '-' }}</td>
                        <td>{{ $site->localite->nom_localite ?? '-' }}</td>
                        <td>{{ $tache?->tache ?? 'Aucune tâche' }}</td>
                        <td>
                            {{ $tache ? number_format((float) $tache->budget, 0, ',', ' ') : '-' }}
                        </td>
                        <td>
                            @if($tache)
                                {{ \Carbon\Carbon::parse($tache->date_debut)->format('d/m/Y') }}
                                -
                                {{ \Carbon\Carbon::parse($tache->date_fin)->format('d/m/Y') }}
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            {{ $tache ? ((int) $tache->completed).' %' : '-' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">
                            Aucun site n’est affecté à cette activité.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
