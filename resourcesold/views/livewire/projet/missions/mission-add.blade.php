<x-slot name="titre">Missions</x-slot>

              <x-slot name="stitre">@include('livewire.projet.menu')</x-slot>
<div>

@include('livewire.errors')
<div class="row">
<x-field nc="12" label="Libelle" fd="libelle"></x-field>
<x-field nc="12" label="Description" fd="description"></x-field>
<button class="btn btn-sm btn-success"  wire:click="storeMission()">Enregistrer</button>

</div></div>