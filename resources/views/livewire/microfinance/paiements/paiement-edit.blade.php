<x-slot name="titre">Paiements</x-slot>

              <x-slot name="stitre">@include('livewire.microfinance.menu')</x-slot>
<div>

@include('livewire.errors')
<div class="row">
<x-field nc="12" label="Credit" fd="credit_id"></x-field>
<x-field nc="12" label="Date_paiement" fd="date_paiement"></x-field>
<x-field nc="12" label="Montant_paye" fd="montant_paye"></x-field>
<x-field nc="12" label="Montant_restant" fd="montant_restant"></x-field>
<button class="btn btn-sm btn-danger"  wire:click="updatePaiement()">Enregistrer</button>

</div></div>