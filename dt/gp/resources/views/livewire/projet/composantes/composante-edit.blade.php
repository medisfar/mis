<x-slot name="titre">composantes</x-slot>

              <x-slot name="stitre">@include('livewire.projet.menu')</x-slot>
<div>

@include('livewire.errors')
<div class="row">
<x-field nc="12" label="Code" fd="code"></x-field>
<x-field nc="12" label="Description" fd="description"></x-field>
<x-select nc="12" label="Projet" fd="projet_id" :options="\App\Models\Projet::tab()"></x-select>
<button class="btn btn-sm btn-danger"  wire:click="updateComposante()">Enregistrer</button>

</div></div>