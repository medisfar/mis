<x-slot name="titre">Albums</x-slot>

              <x-slot name="stitre">@include('livewire.projet.menu')</x-slot>
<div>

@include('livewire.errors')
<div class="row">
<x-select nc="12" label="Projet" fd="projet_id" :options="\App\Models\Projet::tab()"></x-select>
<x-field nc="12" label="Titre" fd="titre"></x-field>
<x-field nc="12" label="Date_photos" fd="date_photos"></x-field>
<button class="btn btn-sm btn-success"  wire:click="storeAlbum()">Enregistrer</button>

</div></div>