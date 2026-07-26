<x-slot name="titre">Localites</x-slot>

              <x-slot name="stitre">@include('livewire.geolocalisation.menu')</x-slot>
<div>

@include('livewire.errors')
<div class="row">
        <x-select nc="3" label="Region" fd="rid" :options="\App\Models\Region::pluck('nom_region','id')"></x-select>
<x-select nc="3" label="Prefecture" fd="pfid" :options="\App\Models\Prefecture::where('region_id',$rid)->pluck('nom_prefecture','id')"></x-select>
<x-select nc="3" label="Sous prefecture" fd="ssprefecture_id" :options="\App\Models\Ssprefecture::where('prefecture_id',$pfid)->pluck('nom_ssprefecture','id')"></x-select>

<x-field nc="12" label="Nom localite" fd="nom_localite"></x-field>

<x-select nc="12" label="Type" fd="l_type" :options="\App\Models\Localite::types()"></x-select>
<button class="btn btn-sm btn-success"  wire:click="storeLocalite()">Enregistrer</button>

</div></div>