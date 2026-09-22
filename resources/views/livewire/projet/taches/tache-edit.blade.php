<x-slot name="titre">Sous-activités</x-slot>

              <x-slot name="stitre">@include('livewire.projet.menu')</x-slot>
<div>

@include('livewire.errors')
<div class="row">
<x-field nc="12" label="Sous-activité" fd="tache"></x-field>
<x-select nc="6" label="Activite" fd="activite_id"
    :options="\App\Models\Activite::whereHas('composante', fn ($query) => $query->where('projet_id', session()->get('pid')))->pluck('activite','id')"></x-select>
<x-select nc="6" label="Site" fd="site_id"
    :options="\App\Models\Activite::find($activite_id)?->sites->pluck('nom','id') ?? collect()"></x-select>

<x-field nc="3" label="Budget" fd="budget"></x-field>
<x-field nc="3" label="Engage" fd="engage"></x-field>
<x-field nc="3" label="Date_debut" fd="date_debut"></x-field>
<x-field nc="3" label="Date_fin" fd="date_fin"></x-field>
<x-field nc="3" label="Avancement" fd="completed"></x-field>
<button class="btn btn-sm btn-danger"  wire:click="updateTache()">Enregistrer</button>

</div></div>
