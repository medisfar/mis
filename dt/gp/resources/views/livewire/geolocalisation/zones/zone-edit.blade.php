<x-slot name="titre">Zones</x-slot>

              <x-slot name="stitre">Edit des zones</x-slot>
<div>

@include('livewire.errors')
<div class="row">
<x-field nc="12" label="Nom zone" fd="nom_zone"></x-field>
<x-select nc="12" label="Localite" fd="localite_id" :options="\App\Models\Localite::tab()"></x-select>
<x-field nc="12" label="Longitude" fd="longitude"></x-field>
<x-field nc="12" label="Lattitude" fd="lattitude"></x-field>
<button class="btn btn-sm btn-danger"  wire:click="updateZone()">Enregistrer</button>

</div></div>