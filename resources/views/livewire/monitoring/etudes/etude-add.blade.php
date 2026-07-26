<x-slot name="titre">Etudes</x-slot>

              <x-slot name="stitre">@include('livewire.monitoring.menu')</x-slot>
<div>

@include('livewire.errors')
<div class="row">
<x-select nc="12" label="Projet" fd="projet_id" :options="\App\Models\Projet::tab()"></x-select>
<x-field nc="12" label="Categorie" fd="categorie"></x-field>
<x-field nc="12" label="Nom" fd="nom"></x-field>
<x-field nc="12" label="Objectif" fd="objectif"></x-field>
<x-field nc="12" label="Methologie" fd="methologie"></x-field>
<x-field nc="12" label="Resultats_principaux" fd="resultats_principaux"></x-field>
<x-field nc="12" label="Reommendations_cles" fd="reommendations_cles"></x-field>
<x-field nc="12" label="Date_debut" fd="date_debut"></x-field>
<x-field nc="12" label="Date_fin" fd="date_fin"></x-field>
<x-field nc="12" label="Statut" fd="statut"></x-field>
<x-field nc="12" label="Zones" fd="Zones"></x-field>
<x-field nc="12" label="Partenaire" fd="partenaire"></x-field>
<x-field nc="12" label="Lecons_apprises" fd="lecons_apprises"></x-field>
<button class="btn btn-sm btn-success"  wire:click="storeEtude()">Enregistrer</button>

</div></div>