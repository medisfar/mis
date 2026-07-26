<x-slot name="titre">Decomptes</x-slot>

              <x-slot name="stitre">@include('livewire.projet.menu')</x-slot>
<div>

@include('livewire.errors')
<div class="row">
<x-select nc="12" label="Activite" fd="activite_id" :options="\App\Models\Activite::tab()"></x-select>
<x-field nc="12" label="Date_previsionnelle" fd="date_previsionnelle"></x-field>
<x-field nc="12" label="Pourcentage" fd="pourcentage"></x-field>
<x-field nc="12" label="Date_effective" fd="date_effective"></x-field>
<button class="btn btn-sm btn-danger"  wire:click="updateDecompte()">Enregistrer</button>

</div></div>