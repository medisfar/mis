<x-slot name="titre">Groupements</x-slot>

              <x-slot name="stitre">@include('livewire.datacollect.menu')</x-slot>
<div>

@include('livewire.errors')
<div class="row">
    <div class="col-md-12"><livewire:localite-selector init="{{$localite_id}}"/></div>
<x-select nc="12" label="Site" fd="site_id" :options="\App\Models\Site::tab()"></x-select>

<x-select nc="12" label="Formulaire" fd="formulaire_id" :options="\App\Models\Formulaire::tab()"></x-select>
<x-field nc="12" label="Nom_groupe" fd="nom_groupe"></x-field>
<x-field nc="12" label="Statut" fd="statut"></x-field>
<button class="btn btn-sm btn-success"  wire:click="storeGroupement()">Enregistrer</button>

</div></div>