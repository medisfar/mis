<x-slot name="titre">Zones</x-slot>

              <x-slot name="stitre">@include('livewire.geolocalisation.menu')</x-slot>
<div>

@include('livewire.errors')
<div class="row">

 <div class="col-md-12">
        <livewire:localite-selector init="{{$localite_id}}"/>
    </div>


<x-field nc="12" label="Nom_zone" fd="nom_zone"></x-field>

<button class="btn btn-sm btn-success"  wire:click="storeZone()">Enregistrer</button>

</div></div>