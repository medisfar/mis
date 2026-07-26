<x-slot name="titre">Indicateurs</x-slot>

              <x-slot name="stitre">@include('livewire.monitoring.menu')</x-slot>
<div>

@include('livewire.errors')
<div class="row">   
    <x-select nc="12" label="Composante" fd="cid"
    :options="\App\Models\Composante::where('projet_id',11)->pluck('code','id')"></x-select>
    
<x-select nc="12" label="Activite" fd="activite_id" :options="\App\Models\Activite::where('composante_id',$cid)->pluck('activite','id')"></x-select>
<x-field nc="12" label="Nom" fd="nom"></x-field>
<x-field nc="6" label="Description" fd="description"></x-field>
<x-field nc="6" label="Formule" fd="formule"></x-field>
<x-select nc="3" label="Frequence" fd="frequence" :options="\App\Models\Indicateur::LesFrequences()"></x-select>

<x-field nc="4" label="Unite_mesure" fd="unite_mesure"></x-field>
<x-select nc="4" label="Type_cible" fd="type_cible" :options="['','min','max']"></x-select>
<x-field nc="4" label="Baseline" fd="baseline"
 ></x-field>
<x-field nc="" label="Baseline_date" fd="baseline_date"></x-field>
<x-select nc="4" label="Est_actif" fd="est_actif" :options="['','Oui','Non']"></x-select>

<button class="btn btn-sm btn-success"  wire:click="updateIndicateur()">Enregistrer</button>

</div></div>