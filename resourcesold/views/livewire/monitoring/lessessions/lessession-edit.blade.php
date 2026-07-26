<x-slot name="titre">Lessessions</x-slot>

              <x-slot name="stitre">@include('livewire.monitoring.menu')</x-slot>
<div>

@include('livewire.errors')
<div class="row">
<x-select nc="12" label="Site" fd="site_id" :options="\App\Models\Site::tab()"></x-select>
<x-field nc="12" label="Date_session" fd="date_session"></x-field>
<x-select nc="12" label="Groupement" fd="groupement_id" :options="\App\Models\Groupement::tab()"></x-select>
<button class="btn btn-sm btn-danger"  wire:click="updateLessession()">Enregistrer</button>

</div></div>