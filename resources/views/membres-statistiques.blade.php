<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Statistiques des membres</title>
    <style>
        body{font-family:Arial,sans-serif;background:#f5f7fb;color:#172033;margin:24px}.card{background:#fff;border:1px solid #dce2eb;border-radius:8px;padding:18px;box-shadow:0 2px 5px #0000000d;margin-bottom:18px}.controls{display:flex;gap:10px;align-items:end;flex-wrap:wrap}label{display:block;font-weight:600;margin-bottom:6px}select,input,textarea,button{border:1px solid #cbd5e1;border-radius:5px;padding:9px 12px;box-sizing:border-box}button{background:#2563eb;color:#fff;border-color:#2563eb;cursor:pointer}.danger{background:#dc2626;border-color:#dc2626}.secondary{background:#64748b;border-color:#64748b}table{width:100%;border-collapse:collapse;margin-top:14px}th,td{border:1px solid #dce2eb;padding:9px;text-align:left}th{background:#eef3f9}.summary{display:flex;gap:14px;flex-wrap:wrap}.metric{background:#eff6ff;border-radius:6px;padding:12px;min-width:130px}.metric strong{display:block;font-size:20px;margin-top:4px}.muted{color:#667085}.bar{height:8px;background:#dbeafe;border-radius:5px;overflow:hidden}.bar span{display:block;height:100%;background:#2563eb}.alert{padding:12px;border-radius:6px;margin-bottom:18px}.success{background:#dcfce7;color:#166534}.error{background:#fee2e2;color:#991b1b}.actions{display:flex;gap:6px}.modal-backdrop{display:none;position:fixed;inset:0;background:#0008;z-index:1000;align-items:center;justify-content:center;padding:20px}.modal-backdrop.open{display:flex}.modal{background:#fff;border-radius:9px;width:min(760px,100%);max-height:90vh;overflow:auto;padding:22px}.modal-header{display:flex;justify-content:space-between;align-items:center}.modal-header button{background:transparent;border:0;color:#334155;font-size:24px;padding:0}.form-group{margin-bottom:14px}.form-group select,.form-group input{width:100%}.modal-footer{display:flex;justify-content:space-between;gap:10px}.data-head,.data-row{display:grid;grid-template-columns:minmax(180px,1fr) minmax(220px,1.5fr) 42px;gap:8px;align-items:center}.data-head{font-weight:600;color:#475569;margin-bottom:6px}.data-row{margin-bottom:8px}.data-row input{width:100%}.remove-field{padding:8px;background:#dc2626;border-color:#dc2626}.add-field{margin:4px 0 14px}.pagination{margin-top:14px}.pagination svg{width:18px!important;height:18px!important;display:inline-block;vertical-align:middle}.pagination nav>div{align-items:center;gap:8px}.pagination a,.pagination span{font-size:14px}@media(max-width:600px){.data-head{display:none}.data-row{grid-template-columns:1fr 42px}.data-row input:first-child{grid-column:1/-1}}</style>
</head>
<body>
    @if(session('status'))<div class="alert success">{{ session('status') }}</div>@endif
    @if($errors->any())<div class="alert error"><strong>Veuillez corriger les erreurs :</strong><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
    <div class="card">
        <h1>Statistiques des membres</h1>
        <p class="muted">{{ $membersWithData }} membre(s) avec des données importées.</p>
        <form method="GET" action="{{ route('membres.statistiques') }}" class="controls">
            <div>
                <label for="member_id">Membre</label>
                <select id="member_id" name="member_id" onchange="this.form.submit()">
                    <option value="">Tous les membres</option>
                    @foreach($members as $member)
                        <option value="{{ $member->id }}" @selected($selectedMemberId === $member->id)>{{ $member->nom }} (#{{ $member->id }})</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="field">Champ à analyser</label>
                <select id="field" name="field">
                    <option value="">Sélectionner un champ</option>
                    @foreach($fields as $field)
                        <option value="{{ $field }}" @selected($selectedField === $field)>{{ $field }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit">Afficher</button>
            <a href="{{ route('membres.statistiques') }}">Réinitialiser les filtres</a>
            <button type="button" onclick="openCreateModal()">Ajouter une session</button>
            <a href="{{ url('/imp') }}">Retour à l'import</a>
        </form>
    </div>

    @if($selectedField !== '')
        <div class="card">
            <h2>{{ $selectedField }}</h2>
            @if($numericSummary)
                <div class="summary">
                    <div class="metric">Minimum<strong>{{ $numericSummary['minimum'] }}</strong></div>
                    <div class="metric">Moyenne<strong>{{ $numericSummary['average'] }}</strong></div>
                    <div class="metric">Maximum<strong>{{ $numericSummary['maximum'] }}</strong></div>
                </div>
            @endif
            <table>
                <thead><tr><th>Valeur</th><th>Nombre</th><th>Pourcentage</th><th>Répartition</th></tr></thead>
                <tbody>
                @forelse($statistics as $statistic)
                    <tr>
                        <td>{{ $statistic['value'] }}</td>
                        <td>{{ $statistic['count'] }}</td>
                        <td>{{ $statistic['percentage'] }} %</td>
                        <td><div class="bar"><span style="width:{{ $statistic['percentage'] }}%"></span></div></td>
                    </tr>
                @empty
                    <tr><td colspan="4">Aucune donnée disponible.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    @endif

    <div class="card">
        <h2>Sessions des membres</h2>
        <table>
            <thead><tr><th>Membre</th><th>Date</th><th>Données</th><th>Actions</th></tr></thead>
            <tbody>
            @forelse($sessions as $sessionRow)
                <tr>
                    <td>{{ $sessionRow->membre_nom }} (#{{ $sessionRow->membre_id }})</td>
                    <td>{{ $sessionRow->date_session }}</td>
                    <td>{{ count(json_decode($sessionRow->donnees, true) ?: []) }} champ(s)</td>
                    <td><div class="actions"><button type="button" onclick="openEditModal({{ $sessionRow->id }})">Modifier</button></div></td>
                </tr>
            @empty
                <tr><td colspan="4">Aucune session disponible.</td></tr>
            @endforelse
            </tbody>
        </table>
        <div class="pagination">{{ $sessions->links() }}</div>
    </div>

    <div id="session-modal" class="modal-backdrop" onclick="closeOnBackdrop(event)">
        <div class="modal" role="dialog" aria-modal="true" aria-labelledby="modal-title">
            <div class="modal-header"><h2 id="modal-title">Ajouter une session</h2><button type="button" onclick="closeModal()" aria-label="Fermer">&times;</button></div>
            <form id="session-form" method="POST" action="{{ route('membres.sessions.store') }}">
                @csrf
                <input id="method-field" type="hidden" name="_method" value="POST">
                <div class="form-group"><label for="modal-member">Membre</label><select id="modal-member" name="membre_id" required>@foreach($members as $member)<option value="{{ $member->id }}">{{ $member->nom }} (#{{ $member->id }})</option>@endforeach</select></div>
                <div class="form-group"><label for="modal-date">Date de session</label><input id="modal-date" type="date" name="date_session" required></div>
                <div class="form-group">
                    <label>Données de la session</label>
                    <div class="data-head"><span>Champ</span><span>Valeur</span><span></span></div>
                    <div id="data-fields"></div>
                    <button class="secondary add-field" type="button" onclick="addDataField()">+ Ajouter un champ</button>
                    <input id="modal-data" type="hidden" name="donnees" value="{}">
                </div>
                <div class="modal-footer"><div><button id="delete-button" class="danger" type="button" style="display:none" onclick="deleteSession()">Supprimer</button></div><div class="actions"><button class="secondary" type="button" onclick="closeModal()">Annuler</button><button type="submit">Enregistrer</button></div></div>
            </form>
            <form id="delete-form" method="POST" action="">@csrf @method('DELETE')</form>
        </div>
    </div>

    @php
        $sessionPayload = $sessions->getCollection()->mapWithKeys(fn ($row) => [$row->id => [
            'id' => $row->id,
            'membre_id' => $row->membre_id,
            'date_session' => $row->date_session,
            'donnees' => json_decode($row->donnees, true),
        ]]);
        $defaultMemberId = $selectedMemberId ?: ($members->first()->id ?? '');
    @endphp
    <script>
        const sessions = {{ Illuminate\Support\Js::from($sessionPayload) }};
        const storeUrl = {{ Illuminate\Support\Js::from(route('membres.sessions.store')) }};
        const updateUrlTemplate = {{ Illuminate\Support\Js::from(route('membres.sessions.update', ['session' => '__ID__'])) }};
        const deleteUrlTemplate = {{ Illuminate\Support\Js::from(route('membres.sessions.destroy', ['session' => '__ID__'])) }};
        const knownFields = {{ Illuminate\Support\Js::from($fields->values()) }};
        let activeSessionId = null;
        function addDataField(key = '', value = '') {
            const row = document.createElement('div');
            row.className = 'data-row';
            const keyInput = document.createElement('input');
            keyInput.type = 'text'; keyInput.className = 'data-key'; keyInput.placeholder = 'Nom du champ'; keyInput.value = key;
            const valueInput = document.createElement('input');
            valueInput.type = 'text'; valueInput.className = 'data-value'; valueInput.placeholder = 'Valeur'; valueInput.value = value ?? '';
            const removeButton = document.createElement('button');
            removeButton.type = 'button'; removeButton.className = 'remove-field'; removeButton.textContent = '×'; removeButton.title = 'Retirer ce champ';
            removeButton.addEventListener('click', () => row.remove());
            row.append(keyInput, valueInput, removeButton);
            document.getElementById('data-fields').appendChild(row);
        }
        function renderDataFields(data) {
            document.getElementById('data-fields').replaceChildren();
            const entries = Object.entries(data || {});
            if (entries.length === 0) addDataField();
            else entries.forEach(([key, value]) => addDataField(key, typeof value === 'object' && value !== null ? JSON.stringify(value) : value));
        }
        function serializeDataFields() {
            const data = {};
            document.querySelectorAll('#data-fields .data-row').forEach(row => {
                const key = row.querySelector('.data-key').value.trim();
                if (key) data[key] = row.querySelector('.data-value').value;
            });
            document.getElementById('modal-data').value = JSON.stringify(data);
        }
        function openCreateModal() {
            activeSessionId = null;
            document.getElementById('modal-title').textContent = 'Ajouter une session';
            document.getElementById('session-form').action = storeUrl;
            document.getElementById('method-field').value = 'POST';
            document.getElementById('modal-member').value = {{ Illuminate\Support\Js::from($defaultMemberId) }};
            document.getElementById('modal-date').value = new Date().toISOString().slice(0, 10);
            renderDataFields(Object.fromEntries(knownFields.map(field => [field, ''])));
            document.getElementById('delete-button').style.display = 'none';
            document.getElementById('session-modal').classList.add('open');
        }
        function openEditModal(id) {
            const session = sessions[id]; activeSessionId = id;
            document.getElementById('modal-title').textContent = 'Modifier la session';
            document.getElementById('session-form').action = updateUrlTemplate.replace('__ID__', id);
            document.getElementById('method-field').value = 'PUT';
            document.getElementById('modal-member').value = session.membre_id;
            document.getElementById('modal-date').value = session.date_session.slice(0, 10);
            renderDataFields(session.donnees);
            document.getElementById('delete-button').style.display = 'inline-block';
            document.getElementById('session-modal').classList.add('open');
        }
        function deleteSession() {
            if (!activeSessionId || !confirm('Supprimer définitivement cette session ?')) return;
            const form = document.getElementById('delete-form');
            form.action = deleteUrlTemplate.replace('__ID__', activeSessionId); form.submit();
        }
        function closeModal() { document.getElementById('session-modal').classList.remove('open'); }
        function closeOnBackdrop(event) { if (event.target.id === 'session-modal') closeModal(); }
        document.addEventListener('keydown', event => { if (event.key === 'Escape') closeModal(); });
        document.getElementById('session-form').addEventListener('submit', serializeDataFields);
    </script>
</body>
</html>
