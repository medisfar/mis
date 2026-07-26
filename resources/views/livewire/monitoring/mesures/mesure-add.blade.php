<x-slot name="titre">Mesures</x-slot>

              <x-slot name="stitre">@include('livewire.monitoring.menu')</x-slot>
<div>

@include('livewire.errors')
<div class="row">
<x-select nc="12" label="Indicateur" fd="indicateur_id" :options="\App\Models\Indicateur::tab()"></x-select>
<x-select nc="12" label="Periode" fd="periode_id" :options="\App\Models\Periode::tab()"></x-select>
<x-field nc="12" label="Cible" fd="cible"></x-field>
<x-field nc="12" label="Valeur" fd="valeur"></x-field>
<x-field nc="12" label="Statut" fd="statut"></x-field>
<x-field nc="12" label="Commentaire" fd="commentaire"></x-field>
<button class="btn btn-sm btn-success"  wire:click="storeMesure()">Enregistrer</button>

</div></div>