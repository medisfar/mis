<x-slot name="titre">Indicateurs</x-slot>

              <x-slot name="stitre">@include('livewire.projet.menu')</x-slot>
<div>

@include('livewire.errors')
<div class="row">
    
<x-field nc="12" label="Nom" fd="nom"></x-field>
<x-select nc="12" label="Frequence" fd="frequence" :options="\App\Models\Indicateur::frequences()"></x-select>
<x-field nc="12" label="Unite_mesure" fd="unite_mesure"></x-field>
<x-field nc="12" label="Baseline" fd="baseline"></x-field>
<x-field nc="12" label="Cible_finale" fd="cible_finale"></x-field>
<x-field nc="12" label="Valeur_actuelle" fd="valeur_actuelle"></x-field>

<x-select nc="12" label="Niveau" fd="niveau" :options="\App\Models\Indicateur::niveaux()"></x-select>

<x-select nc="12" label="Source" fd="source" :options="\App\Models\Indicateur::sources()"></x-select>
<button class="btn btn-sm btn-danger"  wire:click="updateIndicateur()">Enregistrer</button>

</div></div>