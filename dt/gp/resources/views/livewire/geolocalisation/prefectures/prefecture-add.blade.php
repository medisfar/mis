<x-slot name="titre">Prefectures</x-slot>

              <x-slot name="stitre">@include('livewire.geolocalisation.menu')</x-slot>
<div>

@include('livewire.errors')
<div class="row">
<x-select nc="12" label="Region" fd="region_id" :options="\App\Models\Region::tab()"></x-select>
<x-field nc="12" label="Code" fd="code"></x-field>
<x-field nc="12" label="Nom_prefecture" fd="nom_prefecture"></x-field>
<x-select nc="12" label="Type" fd="l_type" :options="\App\Models\Prefecture::types()"></x-select>
<button class="btn btn-sm btn-success"  wire:click="storePrefecture()">Enregistrer</button>

</div></div>