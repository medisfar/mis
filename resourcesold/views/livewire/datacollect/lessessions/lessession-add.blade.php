<x-slot name="titre">Lessessions</x-slot>

              <x-slot name="stitre">@include('livewire.datacollect.menu')</x-slot>
<div>

@include('livewire.errors')
<div class="row">
    <x-select nc="3" label="Localite" fd="localite_id" :options="$locs"></x-select>
    
<x-select nc="12" label="Site" fd="site_id" :options="\App\Models\Site::where('localite_id',$localite_id)->pluck('nom','id')"></x-select>

<x-select nc="12" label="Groupement" fd="groupement_id" :options="\App\Models\Groupement::where('site_id',$site_id)->pluck('nom_groupe','id')"></x-select>

<x-field nc="12" label="Date_session" fd="date_session"></x-field>

<x-select nc="12" label="Type session" fd="typesession_id" :options="\App\Models\Typesession::tab()"></x-fiselecteld>

<button class="btn btn-sm btn-success"  wire:click="storeLessession()">Enregistrer</button>

</div></div>