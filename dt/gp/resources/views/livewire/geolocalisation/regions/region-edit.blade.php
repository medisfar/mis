<x-slot name="titre">Regions</x-slot>

              <x-slot name="stitre">@include('livewire.geolocalisation.menu')</x-slot>
<div>

@include('livewire.errors')
<div class="row">
<x-field nc="12" label="Code" fd="code"></x-field>
<x-field nc="12" label="Nom_region" fd="nom_region"></x-field>
<button class="btn btn-sm btn-danger"  wire:click="updateRegion()">Enregistrer</button>

</div></div>