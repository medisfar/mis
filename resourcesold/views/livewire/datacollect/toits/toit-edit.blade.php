<x-slot name="titre">Toits</x-slot>

              <x-slot name="stitre">@include('livewire.datacollect.menu')</x-slot>
<div>

@include('livewire.errors')
<div class="row">
<x-select nc="12" label="Zone" fd="zone_id" :options="\App\Models\Zone::tab()"></x-select>
<x-field nc="12" label="Adresse" fd="adresse"></x-field>
<button class="btn btn-sm btn-danger"  wire:click="updateToit()">Enregistrer</button>

</div></div>