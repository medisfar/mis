<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Renommer les foyers</title>
    <style>
        body{font-family:Arial,sans-serif;background:#f5f7fb;color:#172033;margin:24px}
        .card{background:#fff;border:1px solid #dce2eb;border-radius:8px;padding:16px;box-shadow:0 2px 5px #0000000d}
        table{width:100%;border-collapse:collapse;margin-top:16px}
        th,td{border:1px solid #dce2eb;padding:8px;text-align:left}
        th{background:#eef3f9}
        button,.link{display:inline-block;border:0;border-radius:4px;padding:10px 16px;color:#fff;text-decoration:none;cursor:pointer}
        button{background:#c62828}.link{background:#2563eb;margin-left:8px}.status{background:#d1fae5;padding:10px}
    </style>
</head>
<body>
    <div class="card">
        <h1>Renommer les foyers</h1>
        @if(session('status'))<p class="status">{{ session('status') }}</p>@endif
        @error('names')<p style="background:#fee2e2;color:#991b1b;padding:10px">{{ $message }}</p>@enderror
        @if($duplicateNames !== [])
            <p style="background:#fee2e2;color:#991b1b;padding:10px">Impossible d'appliquer : noms en double détectés — {{ implode(', ', $duplicateNames) }}.</p>
        @endif
        <p>{{ count($renames) }} foyer(s) seront nommés avec la localité et le site, par exemple arhiba-s1f1.</p>
        <form method="POST" action="{{ route('groupements.rename.apply') }}" onsubmit="return confirm('Renommer tous les foyers affichés ?')">
            @csrf
            <button type="submit" @disabled($duplicateNames !== [])>Appliquer les nouveaux noms</button>
            <a class="link" href="{{ url('/imp') }}">Retour à l'import</a>
        </form>
        <table>
            <thead><tr><th>Site</th><th>Nom(s) actuel(s)</th><th>Doublons fusionnés</th><th>Nouveau nom</th></tr></thead>
            <tbody>
            @forelse($renames as $rename)
                <tr><td>{{ $rename['site'] }}</td><td>{{ $rename['current'] }}</td><td>{{ $rename['merge_count'] }}</td><td>{{ $rename['proposed'] }}</td></tr>
            @empty
                <tr><td colspan="4">Aucun foyer à renommer.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>
