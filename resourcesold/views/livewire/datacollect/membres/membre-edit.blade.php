<x-slot name="titre">Membres</x-slot>

              <x-slot name="stitre">@include('livewire.datacollect.menu')</x-slot>
<div>

@include('livewire.errors')
<div class="row">
<x-select nc="12" label="Menage" fd="menage_id" :options="\App\Models\Menage::tab()"></x-select>
<x-field nc="12" label="Genre" fd="genre"></x-field>
<x-field nc="12" label="Nom" fd="nom"></x-field>
<x-field nc="12" label="Date_naissance" fd="date_naissance"></x-field>
<x-field nc="12" label="Lien_parente" fd="lien_parente"></x-field>
<x-field nc="12" label="Enceinte" fd="enceinte"></x-field>
<button class="btn btn-sm btn-danger"  wire:click="updateMembre()">Enregistrer</button>

</div></div>