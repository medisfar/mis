<x-slot name="titre">Membres</x-slot>

              <x-slot name="stitre">@include('livewire.datacollect.menu')</x-slot>
<div>

@include('livewire.errors')
<div class="row">
<x-select nc="12" label="Menage" fd="menage_id" :options="\App\Models\Menage::tab()" disabled="true"></x-select>
<x-select nc="3" label="Genre" fd="genre" :options="[1=>'M',2=>'F']"></x-select>
<x-field nc="9" label="Nom" fd="nom"></x-field>
<x-field nc="4" label="Date_naissance" fd="date_naissance"></x-field>


<x-select nc="4" label="Lien_parente" fd="lien_parente" 
:options="\App\Models\Membre::parente()"></x-select>

<x-field nc="4" label="Enceinte" fd="enceinte"></x-field>
<button class="btn btn-sm btn-success"  wire:click="storeMembre()">Enregistrer</button> 
<button class="btn btn-sm btn-info"  wire:click="remplir()">Remplir</button>
</div></div>