<x-slot name="titre">Menages</x-slot>

             
<div>

@include('livewire.errors')
<div class="row">
<x-select nc="12" label="Toit" fd="toit_id" :options="\App\Models\Toit::tab()"></x-select>
<x-field nc="12" label="Chef" fd="chef"></x-field>
 <x-select nc="3" label="Region" fd="rid" :options="\App\Models\Region::pluck('nom_region','id')"></x-select>
<x-select nc="3" label="Prefecture" fd="pfid" :options="\App\Models\Prefecture::where('region_id',$rid)->pluck('nom_prefecture','id')"></x-select>
<x-select nc="3" label="Sous prefecture" fd="spfid" :options="\App\Models\Ssprefecture::where('prefecture_id',$pfid)->pluck('nom_ssprefecture','id')"></x-select>
<div class="col-md-12"><livewire:localite-selector/></div>


<button class="btn btn-sm btn-success"  wire:click="storeMenage()">Enregistrer</button>

</div></div>