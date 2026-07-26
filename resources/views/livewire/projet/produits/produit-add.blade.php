<x-slot name="titre">Produits</x-slot>

              <x-slot name="stitre">@include('livewire.projet.menu')</x-slot>
<div>

@include('livewire.errors')
<div class="row">

<x-field nc="12" label="Description" fd="description"></x-field>
<button class="btn btn-sm btn-success"  wire:click="storeProduit()">Enregistrer</button>

</div></div>