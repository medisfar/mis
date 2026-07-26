<x-slot name="titre">Donnees</x-slot>

              <x-slot name="stitre">@include('livewire.dataCollect.menu')</x-slot>
<div>

@include('livewire.errors')
<div class="row">
<x-select nc="12" label="Site" fd="site_id" :options="\App\Models\Site::tab()"></x-select>
<x-select nc="12" label="Groupement" fd="groupement_id" :options="\App\Models\Groupement::tab()"></x-select>
<x-select nc="12" label="Session" fd="session_id" :options="\App\Models\Session::tab()"></x-select>
<x-select nc="12" label="Membre" fd="membre_id" :options="\App\Models\Membre::tab()"></x-select>
<x-field nc="12" label="Metadonnees" fd="metadonnees"></x-field>
<button class="btn btn-sm btn-success"  wire:click="storeDonnee()">Enregistrer</button>

</div></div>