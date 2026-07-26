<x-slot name="titre">Periodes</x-slot>

              <x-slot name="stitre">@include('livewire.monitoring.menu')</x-slot>
<div>

@include('livewire.errors')
<div class="row">
<x-select nc="12" label="Indicateur" fd="indicateur_id" :options="\App\Models\Indicateur::tab()"></x-select>
<x-field nc="12" label="Date_debut" fd="date_debut"></x-field>
<x-field nc="12" label="Date_fin" fd="date_fin"></x-field>
<x-field nc="12" label="Cible" fd="cible"></x-field>
<button class="btn btn-sm btn-danger"  wire:click="updatePeriode()">Enregistrer</button>

</div></div>