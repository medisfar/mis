<x-slot name="titre">Souscomposantes</x-slot>

              <x-slot name="stitre">@include('livewire.projet.menu')</x-slot>
<div>

@include('livewire.errors')
<div class="row">
<x-field nc="12" label="Code" fd="code"></x-field>
<x-field nc="12" label="Description" fd="description"></x-field>
<x-select nc="12" label="Composante" fd="composante_id" :options="\App\Models\Composante::tab()"></x-select>
<button class="btn btn-sm btn-danger"  wire:click="updateSouscomposante()">Enregistrer</button>

</div></div>