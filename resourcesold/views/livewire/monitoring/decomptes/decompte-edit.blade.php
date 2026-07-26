<x-slot name="titre">Decomptes</x-slot>

              <x-slot name="stitre">@include('livewire.monitoring.menu')</x-slot>
<div>

@include('livewire.errors')

<div class="row">

 
<x-field nc="12" label="Montant" fd="montant"></x-field>
<x-field nc="12" label="Date_effective" fd="date_effective"></x-field>
<button class="btn btn-sm btn-danger"  wire:click="updateDecompte()">Enregistrer</button>

</div></div>