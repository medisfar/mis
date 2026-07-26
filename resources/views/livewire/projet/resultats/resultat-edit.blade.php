<x-slot name="titre">Resultats</x-slot>

              <x-slot name="stitre">@include('livewire.projet.menu')</x-slot>
<div>

@include('livewire.errors')
<div class="row">
<x-select nc="12" label="Projet" fd="projet_id" :options="\App\Models\Projet::tab()"></x-select>

<x-select nc="12" label="Mission" fd="mission_id" :options="\App\Models\Mission::tab()"></x-select>
<x-field nc="12" label="Description" fd="description"></x-field>
<button class="btn btn-sm btn-danger"  wire:click="updateResultat()">Enregistrer</button>

</div></div>