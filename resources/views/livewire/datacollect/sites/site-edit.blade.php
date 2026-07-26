<x-slot name="titre">Sites</x-slot>

              <x-slot name="stitre">@include('livewire.datacollect.menu')</x-slot>
<div>

@include('livewire.errors')
<div class="row">
<div class="col-md-12">
        <livewire:localite-selector init="{{$localite_id}}"/>
    </div>
<x-field nc="12" label="Nom" fd="nom"></x-field>
<x-select nc="6" label="Type_point_focal" fd="type_point_focal" :options="['','Adds','Facilitatrices']"></x-field>
<x-field nc="6" label="Nom_point_focal" fd="nom_point_focal"></x-field>
<x-field nc="6" label="Lattitude" fd="lattitude"></x-field>
<x-field nc="6" label="Longitude" fd="longitude"></x-field>
</div>

<button class="btn btn-sm btn-danger"  wire:click="updateSite()">Enregistrer</button>

</div></div>