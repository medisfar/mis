<x-slot name="titre">Echeances</x-slot>

              <x-slot name="stitre">@include('livewire.microfinance.menu')</x-slot>
<div>

@include('livewire.errors')
<div class="row">
<x-field nc="12" label="Date_echeance" fd="date_echeance"></x-field>
<x-field nc="12" label="Montant_paye" fd="montant_paye"></x-field>
<button class="btn btn-sm btn-danger"  wire:click="updateEcheance()">Enregistrer</button>

</div></div>