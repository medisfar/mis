<x-slot name="titre">Produits</x-slot>

              <x-slot name="stitre">@include('livewire.projet.menu')</x-slot>
<div>

@include('livewire.errors')
<div class="row">
<x-select nc="12" label="Resultat" fd="resultat_id" :options="\App\Models\Resultat::tab()"></x-select>
<x-field nc="12" label="Description" fd="description"></x-field>
<button class="btn btn-sm btn-success"  wire:click="storeProduit()">Enregistrer</button>

</div></div>