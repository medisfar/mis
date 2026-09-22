<x-slot name="titre">Grouxxpements</x-slot>

              <x-slot name="stitre">@include('livewire.beneficiaire.menu')</x-slot>
<div>

@include('livewire.errors')
<div class="row">
        <div class="col-md-12"><livewire:localite-selector init="{{$localite_id}}"/></div>
<x-select nc="6" label="Projet" fd="projet_id" :options="\App\Models\Projet::whereKey($projet_id)->pluck('libelle','id')" disabled="true"></x-select>

<x-select nc="6" label="Site" fd="site_id" :options="\App\Models\Site::where('projet_id',$projet_id)->where('localite_id',$localite_id)->pluck('nom','id')"></x-select>

<x-field nc="9" label="Nom_groupe" fd="nom_groupe"></x-field>
<x-field nc="3" label="Statut" fd="statut"></x-field>
<button class="btn btn-sm btn-success"  wire:click="storeGroupement()">Enregistrer</button>

</div></div>
