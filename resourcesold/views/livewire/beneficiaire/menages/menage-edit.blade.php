<x-slot name="titre">Menages</x-slot>

            
<div>

@include('livewire.errors')
<div class="row">
<x-select nc="12" label="Toit" fd="toit_id" :options="\App\Models\Toit::tab()"></x-select>
<x-field nc="12" label="Chef" fd="chef"></x-field>
 <x-select nc="3" label="Region" fd="rid" :options="\App\Models\Region::pluck('nom_region','id')"></x-select>
<x-select nc="3" label="Prefecture" fd="pfid" :options="\App\Models\Prefecture::where('region_id',$rid)->pluck('nom_prefecture','id')"></x-select>
<x-select nc="3" label="Sous prefecture" fd="spfid" :options="\App\Models\Ssprefecture::where('prefecture_id',$pfid)->pluck('nom_ssprefecture','id')"></x-select>
<x-select nc="3" label="Localite" fd="localite_id"
:options="\App\Models\Localite::where('ssprefecture_id',$spfid)->pluck('nom_localite','id')"></x-select>

<button class="btn btn-sm btn-danger"  wire:click="updateMenage()">Enregistrer</button>

</div></div>