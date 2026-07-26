<x-slot name="titre">Taches</x-slot>

              <x-slot name="stitre">@include('livewire.projet.menu')</x-slot>
<div>

@include('livewire.errors')
<div class="row">
<x-field nc="12" label="Tache" fd="tache"></x-field>
<x-select nc="12" label="Activite" fd="activite_id" :options="\App\Models\Activite::tab()"></x-select>
<x-select  nc="12" label="Site" fd="site_id" :options="\App\Models\Site::tab()"></x-select>
<x-field nc="12" label="Date_debut" fd="date_debut"></x-field>
<x-field nc="12" label="Date_fin" fd="date_fin"></x-field>
<x-field nc="12" label="Completed" fd="completed"></x-field>
<button class="btn btn-sm btn-danger"  wire:click="updateTache()">Enregistrer</button>

</div></div>