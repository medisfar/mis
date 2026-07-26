<x-slot name="titre">Projets</x-slot>

              <x-slot name="stitre">@include('livewire.projet.menu')</x-slot>
<div>

@include('livewire.errors')
<div class="row">
<x-field nc="12" label="Code" fd="code"></x-field>
<x-field nc="12" label="Nom projet" fd="nom_projet"></x-field>
<x-field nc="12" label="Budget" fd="budget"></x-field>
<x-field nc="12" label="Date debut" fd="date_debut"></x-field>
<x-field nc="12" label="Date fin" fd="date_fin"></x-field>
<x-field nc="12" label="Statut" fd="statut"></x-field>
<button class="btn btn-sm btn-success"  wire:click="storeProjet()">Enregistrer</button>

</div></div>