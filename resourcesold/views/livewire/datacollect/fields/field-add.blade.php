<x-slot name="titre">Fields</x-slot>

              <x-slot name="stitre">@include('livewire.datacollect.menu')</x-slot>
<div>

@include('livewire.errors')
<div class="row">
<x-field nc="12" label="Nom" fd="nom"></x-field>
<x-select nc="12" label="Psession" fd="psession_id" :options="\App\Models\Psession::tab()"></x-select>
<x-field nc="12" label="Row" fd="row"></x-field>
<x-field nc="12" label="Col" fd="col"></x-field>
<x-field nc="12" label="Options" fd="options"></x-field>
<button class="btn btn-sm btn-success"  wire:click="storeField()">Enregistrer</button>

</div></div>