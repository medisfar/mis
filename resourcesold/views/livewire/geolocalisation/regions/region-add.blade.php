<x-slot name="titre">Regions</x-slot>

              <x-slot name="stitre">@include('livewire.geolocalisation.menu')</x-slot>
<div>

@include('livewire.errors')
<div class="row">
<x-field nc="12" label="Code" fd="code"></x-field>
<x-field nc="12" label="Nom_region" fd="nom_region"></x-field>
<button class="btn btn-sm btn-success  col-md-2" style="margin:auto;height:50px"  wire:click="storeRegion()">Enregistrer</button>

</div></div>