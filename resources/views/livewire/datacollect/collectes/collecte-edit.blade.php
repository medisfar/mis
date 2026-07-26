<x-slot name="titre">Collectes</x-slot>

              <x-slot name="stitre">@include('livewire.datacollect.menu')</x-slot>
<div>

@include('livewire.errors')
<div class="row">
<x-select nc="12" label="Projet" fd="projet_id" :options="\App\Models\Projet::tab()"></x-select>
<x-select nc="12" label="Site" fd="site_id" :options="\App\Models\Site::tab()"></x-select>
<button class="btn btn-sm btn-danger"  wire:click="updateCollecte()">Enregistrer</button>

</div></div>