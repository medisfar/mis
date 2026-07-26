<x-slot name="titre">Sites</x-slot>

              <x-slot name="stitre">@include('livewire.projet.menu')</x-slot>
<div>

@include('livewire.errors')
<div class="row">
<x-field nc="12" label="Nom" fd="nom"></x-field>
<x-field nc="12" label="Type_point_focal" fd="type_point_focal"></x-field>
<x-field nc="12" label="Nom_point_focal" fd="nom_point_focal"></x-field>
<x-select nc="12" label="Localite" fd="localite_id" :options="\App\Models\Localite::tab()"></x-select>
<x-field nc="12" label="Lattitude" fd="lattitude"></x-field>
<x-field nc="12" label="Longitude" fd="longitude"></x-field>
<button class="btn btn-sm btn-success"  wire:click="storeSite()">Enregistrer</button>

</div></div>