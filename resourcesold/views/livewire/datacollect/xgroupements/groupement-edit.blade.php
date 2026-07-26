<x-slot name="titre">Groupements</x-slot>

              <x-slot name="stitre">@include('livewire.datacollect.menu')</x-slot>
<div>

@include('livewire.errors')
<div class="row">
<x-field nc="12" label="Nom_groupe" fd="nom_groupe"></x-field>
<x-select nc="12" label="Site" fd="site_id" :options="\App\Models\Site::tab()"></x-select>
<x-field nc="12" label="Statut" fd="statut"></x-field>
<button class="btn btn-sm btn-danger"  wire:click="updateGroupement()">Enregistrer</button>

</div></div>