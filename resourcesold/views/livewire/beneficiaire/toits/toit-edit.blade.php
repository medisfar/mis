<x-slot name="titre">Toits</x-slot>

             
<div>

@include('livewire.errors')
<div class="row">
<x-field nc="12" label="Adresse" fd="adresse"></x-field>
<button class="btn btn-sm btn-danger"  wire:click="updateToit()">Enregistrer</button>

</div></div>