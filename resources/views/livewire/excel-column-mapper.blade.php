<div class="min-h-screen bg-slate-50 py-8">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <p class="text-sm font-semibold uppercase tracking-wider text-indigo-600">Data import</p>
            <h1 class="mt-2 text-3xl font-bold text-slate-900">Associate Excel columns</h1>
            <p class="mt-2 max-w-2xl text-slate-600">Upload a spreadsheet, select its destination table, and match each Excel column to a database column before importing.</p>
        </div>

        <div class="grid gap-6 lg:grid-cols-[320px_1fr]">
            <aside class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
                <h2 class="text-lg font-semibold text-slate-900">1. Choose source</h2>
                <label class="mt-5 block text-sm font-medium text-slate-700">Excel or CSV file</label>
                <input type="file" wire:model="file" accept=".xlsx,.xls,.csv,.txt" class="mt-2 block w-full rounded-lg border border-slate-300 p-2 text-sm">
                @error('file') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                <button wire:click="inspectFile" wire:loading.attr="disabled" class="mt-4 w-full rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-indigo-700 disabled:opacity-50">Inspect file</button>

                <h2 class="mt-8 text-lg font-semibold text-slate-900">2. Choose destination</h2>
                <label class="mt-5 block text-sm font-medium text-slate-700">Database table</label>
                <select wire:model.live="table" class="mt-2 block w-full rounded-lg border border-slate-300 bg-white p-2.5 text-sm">
                    <option value="">Select a table…</option>
                    @foreach($tables as $name)<option value="{{ $name }}">{{ $name }}</option>@endforeach
                </select>
                @error('table') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                @if($saved)<p class="mt-4 rounded-lg bg-emerald-50 p-3 text-sm text-emerald-700">Mapping saved for the next import.</p>@endif
            </aside>

            <section class="rounded-2xl bg-white shadow-sm ring-1 ring-slate-200">
                @if(count($excelColumns))
                    <div class="flex items-center justify-between border-b border-slate-200 p-6"><div><h2 class="text-lg font-semibold text-slate-900">3. Map columns</h2><p class="mt-1 text-sm text-slate-500">{{ count($excelColumns) }} Excel columns · {{ count($dbColumns) }} database columns</p></div><button wire:click="saveMapping" class="rounded-lg bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-emerald-700">Save mapping</button></div>
                    <div class="overflow-x-auto"><table class="w-full text-left text-sm"><thead class="bg-slate-50 text-xs uppercase tracking-wide text-slate-500"><tr><th class="px-6 py-4">Excel column</th><th class="px-6 py-4">Example value</th><th class="px-6 py-4">Database column</th></tr></thead><tbody class="divide-y divide-slate-100">@foreach($excelColumns as $column)<tr><td class="whitespace-nowrap px-6 py-4 font-medium text-slate-900">{{ $column }}</td><td class="max-w-xs truncate px-6 py-4 text-slate-500">{{ $sample[0][$column] ?? '—' }}</td><td class="px-6 py-3"><select wire:model="mapping.{{ $column }}" class="w-full rounded-lg border border-slate-300 bg-white p-2"><option value="">Do not import</option>@foreach($dbColumns as $dbColumn)<option value="{{ $dbColumn }}">{{ $dbColumn }}</option>@endforeach</select></td></tr>@endforeach</tbody></table></div>
                @else
                    <div class="flex min-h-[420px] items-center justify-center p-8 text-center"><div><div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-indigo-50 text-2xl">↔</div><h2 class="mt-4 text-lg font-semibold text-slate-900">Your mapping will appear here</h2><p class="mt-2 max-w-sm text-sm text-slate-500">Upload a file, inspect its headers, then choose a destination table to begin matching columns.</p></div></div>
                @endif
            </section>
        </div>
    </div>
</div>
