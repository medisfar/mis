<x-slot name="titre">Menages</x-slot>

              <x-slot name="stitre">@include('livewire.datacollect.menu')</x-slot>
<div>

@include('livewire.errors')
<div class="row">
<x-select nc="12" label="Localite" fd="localite_id" :options="\App\Models\Localite::tab()"></x-select>
<x-select nc="12" label="Toit" fd="toit_id" :options="\App\Models\Toit::tab()"></x-select>
<x-field nc="12" label="Chef" fd="chef"></x-field>
<x-field nc="12" label="Conjoint" fd="conjoint"></x-field>
<x-field nc="12" label="Tel1" fd="tel1"></x-field>
<x-field nc="12" label="Tel2" fd="tel2"></x-field>
<button class="btn btn-sm btn-danger"  wire:click="updateMenage()">Enregistrer</button>

</div></div>