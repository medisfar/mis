<x-slot name="titre">Psessions</x-slot>

              <x-slot name="stitre">@include('livewire.datacollect.menu')</x-slot>
<div>

@include('livewire.errors')
<div class="row">
<x-field nc="12" label="Nom" fd="nom"></x-field>
<x-select nc="12" label="Projet" fd="projet_id" :options="\App\Models\Projet::tab()"></x-select>
<x-select nc="12" label="Actif" fd="actif" :options="['','Non','Oui']"></x-select>
<button class="btn btn-sm btn-success"  wire:click="storePsession()">Enregistrer</button>

</div></div>