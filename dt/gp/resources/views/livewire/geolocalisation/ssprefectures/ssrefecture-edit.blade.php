<x-slot name="titre">Ssrefectures</x-slot>

              <x-slot name="stitre">@include('livewire.geolocalisation.menu')</x-slot>
<div>

@include('livewire.errors')
<div class="row">
<x-select nc="12" label="Prefecture" fd="prefecture_id" :options="\App\Models\Prefecture::tab()"></x-select>
<x-field nc="12" label="Code" fd="code"></x-field>
<x-field nc="12" label="Nom ssprefecture" fd="nom_ssprefecture"></x-field>
<x-select nc="12" label="Type" fd="l_type" :options="\App\Models\Ssrefecture::types()"></x-select>
<button class="btn btn-sm btn-danger"  wire:click="updateSsrefecture()">Enregistrer</button>

</div></div>