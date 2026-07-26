<x-slot name="titre">Echeances</x-slot>

              <x-slot name="stitre">@include('livewire.pret.menu')</x-slot>
<div>

@include('livewire.errors')
<div class="row">
<x-select nc="12" label="Membre" fd="membre_id" :options="\App\Models\Membre::tab()"></x-select>
<x-field nc="12" label="Montant" fd="montant"></x-field>
<x-field nc="12" label="Date_paiement" fd="date_paiement"></x-field>
<button class="btn btn-sm btn-danger"  wire:click="updateEcheance()">Enregistrer</button>

</div></div>