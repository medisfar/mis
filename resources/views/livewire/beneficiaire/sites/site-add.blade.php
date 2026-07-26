<x-slot name="titre">Sites</x-slot>

              <x-slot name="stitre">@include('livewire.beneficiaire.menu')</x-slot>
<div>

@include('livewire.errors')
<div class="row">
<x-field nc="12" label="Nom" fd="nom"></x-field>
<x-select nc="12" label="Activite" fd="activite_id" :options="\App\Models\Activite::tab()"></x-select>
<button class="btn btn-sm btn-success"  wire:click="storeSite()">Enregistrer</button>

</div></div>