<x-slot name="titre">Menageso</x-slot>

              <x-slot name="stitre">@include('livewire.geolocalisation.menu')</x-slot>
<div>

@include('livewire.errors')
<div class="row">
<x-select nc="12" label="Toit" fd="toit_id" :options="\App\Models\Toit::tab()"></x-select>
<x-field nc="12" label="Chef" fd="chef"></x-field>
<x-select nc="12" label="Localite" fd="localite_id" :options="\App\Models\Localite::tab()"></x-select>
<button class="btn btn-sm btn-success"  wire:click="storeMenage()">Enregistrer</button>

</div></div>