<x-slot name="titre">Epargnes</x-slot>

              <x-slot name="stitre">@include('livewire.microfinance.menu')</x-slot>
<div>

@include('livewire.errors')
<div class="row">
<x-select nc="12" label="Membre" fd="membre_id" :options="\App\Models\Membre::tab()"></x-select>
<x-field nc="12" label="Date_operation" fd="date_operation"></x-field>
<x-field nc="12" label="Type" fd="type"></x-field>
<x-field nc="12" label="Montant" fd="montant"></x-field>
<button class="btn btn-sm btn-danger"  wire:click="updateEpargne()">Enregistrer</button>

</div></div>