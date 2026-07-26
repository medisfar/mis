<x-slot name="titre">Bailleurs</x-slot>

              <x-slot name="stitre">@include('livewire.projet.menu')</x-slot>
<div>

@include('livewire.errors')
<div class="row">
<x-field nc="12" label="Code" fd="code"></x-field>
<x-field nc="12" label="Nom_bailleur" fd="nom_bailleur"></x-field>
<button class="btn btn-sm btn-danger"  wire:click="updateBailleur()">Enregistrer</button>

</div></div>