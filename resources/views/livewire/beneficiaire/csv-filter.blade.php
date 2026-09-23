<x-slot name="titre">Recherche CSV</x-slot>

<div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="csv-site">Site</label>
            <select id="csv-site" class="form-control" wire:model.live="site">
                <option value="">Tous les sites</option>
                @foreach($sites as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <label for="csv-foyer">Foyer</label>
            <select id="csv-foyer" class="form-control" wire:model.live="foyer">
                <option value="">Tous les foyers</option>
                @foreach($foyers as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <label for="csv-mere-conseillere">Mère conseillère</label>
            <select id="csv-mere-conseillere" class="form-control" wire:model.live="mereConseillere">
                <option value="">Toutes les mères conseillères</option>
                @foreach($mereConseilleres as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <p>{{ count($rows) }} ligne(s) trouvée(s).</p>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-sm">
            <thead>
                <tr>
                    <th>Ligne</th>
                    @foreach($headers as $header)
                        <th>{{ $header }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @forelse($rows as $row)
                    <tr>
                        <td>{{ $row['line'] }}</td>
                        @foreach($row['values'] as $value)
                            <td>{{ $value }}</td>
                        @endforeach
                    </tr>
                @empty
                    <tr><td colspan="{{ count($headers) + 1 }}">Aucune ligne trouvée.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
