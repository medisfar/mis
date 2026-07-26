<x-slot name="titre">Secteurs</x-slot>

              <x-slot name="stitre">@include('livewire.monitoring.menu')</x-slot>
<div>

@include('livewire.errors')
<div class="row">
<x-field nc="12" label="Nom_secteur" fd="nom_secteur"></x-field>
<x-select nc="12" label="Mission" fd="mission_id" :options="\App\Models\Mission::tab()"></x-select>
<button class="btn btn-sm btn-danger"  wire:click="updateSecteur()">Enregistrer</button>

</div></div>