<x-slot name="titre">composantes</x-slot>

              <x-slot name="stitre">@include('livewire.projet.menu')</x-slot>
<div>

@include('livewire.errors')
<div class="row">
<x-select nc="3" label="Projet" fd="projet_id" :options="\App\Models\Projet::tab()" disabled="true"></x-select>
<x-field nc="3" label="Code" fd="code"></x-field>
<x-field nc="6" label="Description" fd="description"></x-field>
<x-field nc="12" label="Budget" fd="budget"></x-field>

<button class="btn btn-sm btn-success"  wire:click="updateComposante()">Modifier</button>
</div></div>