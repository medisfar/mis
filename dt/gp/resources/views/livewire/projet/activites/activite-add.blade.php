<x-slot name="titre">Activites</x-slot>

              <x-slot name="stitre">@include('livewire.projet.menu')</x-slot>
<div>

@include('livewire.errors')
<div class="row">
<x-field nc="12" label="Nom_activite" fd="nom_activite"></x-field>
<x-select nc="12" label="Composante" fd="composante_id" :options="\App\Models\Composante::tab()"></x-select>
<x-select nc="12" label="Sous_composante" fd="sous_composante_id" :options="\App\Models\Souscomposante::tab()"></x-select>
<x-field nc="12" label="Date_debut" fd="date_debut"></x-field>
<x-field nc="12" label="Date_fin" fd="date_fin"></x-field>
<x-field nc="12" label="Completed" fd="completed"></x-field>
<button class="btn btn-sm btn-success"  wire:click="storeActivite()">Enregistrer</button>

</div></div>