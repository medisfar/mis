<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Attribution des utilisateurs aux sites
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session('status'))
                <div class="rounded bg-green-100 text-green-800 px-4 py-3">
                    {{ session('status') }}
                </div>
            @endif

            <div class="bg-white shadow rounded-lg p-6">
                <form method="POST" action="{{ route('users-sites.store') }}" class="grid md:grid-cols-3 gap-4 items-end">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium mb-1">Utilisateur</label>
                        <select name="user_id" required class="w-full rounded border-gray-300">
                            <option value="">Sélectionner</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} — {{ $user->email }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Site</label>
                        <select name="site_id" required class="w-full rounded border-gray-300">
                            <option value="">Sélectionner</option>
                            @foreach ($sites as $site)
                                <option value="{{ $site->id }}">{{ $site->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button class="rounded bg-blue-600 text-white px-4 py-2 hover:bg-blue-700">
                        Attribuer
                    </button>
                </form>
                @error('user_id') <p class="text-red-600 mt-2">{{ $message }}</p> @enderror
                @error('site_id') <p class="text-red-600 mt-2">{{ $message }}</p> @enderror
            </div>

            <div class="bg-white shadow rounded-lg overflow-hidden">
                <table class="w-full">
                    <thead class="bg-gray-100">
                        <tr><th class="text-left p-3">Utilisateur</th><th class="text-left p-3">Site attribué</th></tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="border-t">
                                <td class="p-3">{{ $user->name }}<div class="text-sm text-gray-500">{{ $user->email }}</div></td>
                                <td class="p-3">{{ $user->sites->first()?->nom ?? 'Non attribué' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
