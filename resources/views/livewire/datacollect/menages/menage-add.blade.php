<x-slot name="titre">Menages</x-slot>

              <x-slot name="stitre">@include('livewire.datacollect.menu')</x-slot>
<div>

@include('livewire.errors')
<div class="row">
    <div class="col-md-12">
        <livewire:localite-selector  init="{{$localite_id}}"/></div>

<x-select nc="12" label="Toit" fd="toit_id" :options="\App\Models\Toit::tab()"></x-select>
<x-field nc="6" label="Chef" fd="chef"></x-field>
<x-field nc="6" label="Conjoint" fd="conjoint"></x-field>
<x-field nc="6" label="Tel1" fd="tel1"></x-field>
</div>
<button class="btn btn-sm btn-success"  wire:click="storeMenage()">Enregistrer</button>

</div>