<x-slot name="titre">Indicateurs</x-slot>

              <x-slot name="stitre">@include('livewire.monitoring.menu')</x-slot>
<div>

@include('livewire.errors')
<div class="row">
<x-select nc="12" label="Activite" fd="activite_id" :options="\App\Models\Activite::tab()"></x-select>
<x-field nc="12" label="Nom" fd="nom"></x-field>
<x-field nc="12" label="Description" fd="description"></x-field>
<x-select nc="12" label="Frequence" fd="frequence" :options="\App\Models\Indicateur::LesFrequences()"></x-select>
<x-field nc="12" label="Formule" fd="formule"></x-field>
<x-field nc="12" label="Unite_mesure" fd="unite_mesure"></x-field>
<x-field nc="12" label="Type_cible" fd="type_cible"></x-field>
<x-select nc="12" label="Baseline" fd="baseline"
 :options="['','min','max']"></x-select>
<x-field nc="12" label="Baseline_date" fd="baseline_date"></x-field>
<x-select nc="12" label="Est_actif" fd="est_actif" :options="['','Oui','Non']"></x-select>
</div></div>