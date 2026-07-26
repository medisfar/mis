<x-slot name="titre">Indicateurs</x-slot>

              <x-slot name="stitre">@include('livewire.projet.menu')</x-slot>
<div>

@include('livewire.errors')

<div class="row">
    
    
<x-select nc="12" label="Composante" fd="cid" :options="\App\Models\Composante::where('projet_id',session()->get('pid'))->pluck('code','id')"></x-select>
<x-select nc="12" label="Activite" fd="activite_id" :options="\App\Models\Activite::where('composante_id',$cid)->pluck('activite','id')"></x-select>
<x-field nc="12" label="Nom" fd="nom"></x-field>
<x-select nc="12" label="Frequence" fd="frequence" :options="\App\Models\Indicateur::frequences()"></x-select>
<x-field nc="12" label="Unite_mesure" fd="unite_mesure"></x-field>
<x-field nc="12" label="Baseline" fd="baseline"></x-field>
<x-field nc="12" label="Cible_finale" fd="cible_finale"></x-field>
<x-field nc="12" label="Valeur_actuelle" fd="valeur_actuelle"></x-field>

<x-select nc="12" label="Niveau" fd="niveau" :options="\App\Models\Indicateur::niveaux()"></x-select>

<x-select nc="12" label="Source" fd="source" :options="\App\Models\Indicateur::sources()"></x-select>
<button class="btn btn-sm btn-success"  wire:click="storeIndicateur()">Enregistrer</button>

</div></div>