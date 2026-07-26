<x-slot name="titre">Activites</x-slot>

              <x-slot name="stitre">@include('livewire.projet.menu')</x-slot>
<div>

@include('livewire.errors')
<div class="row">

   

<x-select nc="4" label="Projet" fd="pid" :options="\App\Models\Projet::tab()"></x-select>

<x-select nc="4" label="Composante" fd="composante_id" :options="\App\Models\Composante::where('projet_id',$pid)->pluck('code','id')"></x-select>

<x-select nc="4" label="Sous_composante" fd="sous_composante_id" :options="\App\Models\Souscomposante::where('composante_id',$composante_id)->pluck('code','id')"></x-select>

<x-field nc="12" label="Activite" fd="activite"></x-field>
<x-field nc="3" label="Date_debut" fd="date_debut"></x-field>
<x-field nc="3" label="Date_fin" fd="date_fin"></x-field>
<x-field nc="3" label="Budget" fd="budget"></x-field>
<x-field nc="3" label="Completed" fd="completed"></x-field>
<button class="btn btn-sm btn-danger"  wire:click="updateActivite()">Enregistrer</button>

</div></div>