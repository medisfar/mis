<x-slot name="titre">Typesessions</x-slot>

              <x-slot name="stitre">@include('livewire.projet.menu')</x-slot>
<div>

@include('livewire.errors')
<div class="row">
<x-field nc="12" label="Nom" fd="nom"></x-field>
<button class="btn btn-sm btn-danger"  wire:click="updateTypesession()">Enregistrer</button>

</div></div>