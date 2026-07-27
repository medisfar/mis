<x-slot name="titre">Donnees</x-slot>

              <x-slot name="stitre">@include('livewire.datacollect.menu')</x-slot>
<div>

@include('livewire.errors')
<div class="row">
<x-select nc="12" label="Collecte" fd="collecte_id" :options="\App\Models\Collecte::tab()"></x-select>
<x-select nc="12" label="Session" fd="session_id" :options="\App\Models\Session::tab()"></x-select>
<x-select nc="12" label="Membre" fd="membre_id" :options="\App\Models\Membre::tab()"></x-select>
<x-field nc="12" label="Date_session" fd="date_session"></x-field>
<x-field nc="12" label="Donnees" fd="donnees"></x-field>
<button class="btn btn-sm btn-danger"  wire:click="updateDonnee()">Enregistrer</button>

</div></div>