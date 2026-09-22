<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Import preview</title>
    <style>body{font-family:Arial,sans-serif;background:#f5f7fb;color:#172033;margin:24px}.card{background:#fff;border:1px solid #dce2eb;border-radius:8px;margin-bottom:18px;padding:16px;box-shadow:0 2px 5px #0000000d}table{width:100%;border-collapse:collapse;margin-top:10px}th,td{border:1px solid #dce2eb;padding:8px;text-align:left;vertical-align:top}th{background:#eef3f9}.nested{margin:0 0 0 18px}.muted{color:#667085;font-size:13px}</style>
</head>
<body>
    <h1>Import preview</h1>
    @if(session('status'))<p style="background:#d1fae5;padding:10px">{{ session('status') }}</p>@endif
    <form method="POST" action="{{ route('imp.import') }}" onsubmit="return confirm('This will truncate sites, groupements, menages and membres. Continue?')">
        @csrf
        <button type="submit" style="background:#c62828;color:white;border:0;border-radius:4px;padding:10px 16px">Truncate and import CSV</button>
        <a href="{{ url('/dashboard') }}" style="display:inline-block;margin-left:8px;background:#2563eb;color:white;border-radius:4px;padding:10px 16px;text-decoration:none">Dashboard</a>
    </form>
    <p class="muted">Sites: {{ count($dtt['sites']) }}</p>
    @foreach($dtt['sites'] as $site)
        <div class="card">
          
            <h2>Site: {{ $site['nom'] }} — {{ $site['facilitatrice'] }}</h2>
            <table><thead><tr><th>Foyer</th><th>Mère conseillère</th><th>Ménages et membres</th></tr></thead><tbody>
            @foreach($site['foyers'] as $foyer)
            @php \App\Models\Groupement::create($foyer); @endphp
                <tr><td>{{ $foyer['nom_groupe'] ?? $foyer['foyer'] ?? '' }}</td><td>{{ $foyer['mere_conseillere'] ?? '' }}</td><td>
                    @foreach($foyer['menages'] as $menage)
                        <table class="nested"><thead><tr><th>Ménage</th><th>Téléphone</th><th>Membres</th></tr></thead><tbody><tr><td>{{ $menage['chef'] }}</td><td>{{ $menage['tel'] }}</td><td>
                            <table><thead><tr><th>Nom</th><th>Genre</th><th>Âge</th></tr></thead><tbody>@foreach($menage['membres'] as $membre)<tr><td>{{ $membre['nom'] }}</td><td>{{ $membre['genre'] }}</td><td>{{ $membre['age'] }}</td></tr>@endforeach</tbody></table>
                        </td></tr></tbody></table>
                    @endforeach
                </td></tr>
            @endforeach
            </tbody></table>
        </div>
    @endforeach
</body>
</html>
