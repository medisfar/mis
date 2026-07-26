<x-slot name="titre">Projets</x-slot>
<x-slot name="stitre">@include('livewire.projet.menu')</x-slot>
<div>

@include('livewire.errors')
<div class="row">
<x-field nc="3" label="Code" fd="code"></x-field>
<x-field nc="3" label="Libelle" fd="libelle"></x-field>
<x-field nc="6" label="Nom_projet" fd="nom_projet"></x-field>
<x-field nc="12" label="Objectifs" fd="objectifs"></x-field>
<x-field nc="3" label="Budget" fd="budget"></x-field>
<x-field nc="3" label="Date_debut" fd="date_debut"></x-field>
<x-field nc="3" label="Date_fin" fd="date_fin"></x-field>
<x-select nc="3" label="Statut" fd="l_statut" :options="\App\Models\Projet::statuts()"></x-select>
<x-field nc="12" label="Commentaire" fd="commentaire"></x-field>
<button class="btn btn-sm btn-danger"  wire:click="updateProjet()">Enregistrer</button>
</div>
</div></div>