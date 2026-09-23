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
        <a href="{{ url('/beneficiaire/csv-filter') }}" style="display:inline-block;margin-left:8px;background:#0f766e;color:white;border-radius:4px;padding:10px 16px;text-decoration:none">CSV Filter</a>
    </form>
    <p class="muted">Mères conseillères: {{ count($mereConseillereMereCounts) }}</p>
    <table>
        <thead><tr><th>Mère conseillère</th><th>Nombre</th></tr></thead>
        <tbody>
        @foreach($mereConseillereMereCounts as $mereConseillere => $count)
            <tr><td>{{ $mereConseillere }}</td><td>{{ $count }}</td></tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>
