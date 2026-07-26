<x-slot name="titre">Localites</x-slot>

              <x-slot name="stitre">@include('livewire.geolocalisation.menu')</x-slot>
<div>

@include('livewire.errors')
<div class="row">
<x-field nc="12" label="Nom localite" fd="nom_localite"></x-field>
<x-select nc="12" label="Ssprefecture" fd="ssprefecture_id" :options="\App\Models\Ssprefecture::tab()"></x-select>
<x-select nc="12" label="Type" fd="l_type" :options="\App\Models\Localite::types()"></x-select>
<button class="btn btn-sm btn-danger"  wire:click="updateLocalite()">Enregistrer</button>

</div></div>