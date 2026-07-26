<x-slot name="titre">Menages</x-slot>

             
<div>

@include('livewire.errors')
<div class="row">
<x-select nc="12" label="Toit" fd="toit_id" :options="\App\Models\Toit::tab()"></x-select>
<x-field nc="12" label="Chef" fd="chef"></x-field>
<x-field nc="12" label="conjoint" fd="conjoint"></x-field>
<x-field nc="12" label="tel1" fd="tel1"></x-field>  
<div class="col-md-12"><livewire:localite-selector/></div>


<button class="btn btn-sm btn-success"  wire:click="storeMenage()">Enregistrer</button>

</div></div>