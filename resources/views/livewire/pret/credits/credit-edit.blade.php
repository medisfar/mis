<x-slot name="titre">Credits</x-slot>

              <x-slot name="stitre">@include('livewire.datacollect.menu')</x-slot>
<div>

@include('livewire.errors')
<div class="row">
<x-select nc="12" label="Membre" fd="membre_id" :options="\App\Models\Membre::tab()"></x-select>
<x-field nc="12" label="Date_credit" fd="date_credit"></x-field>
<x-field nc="12" label="Montant" fd="montant"></x-field>
<x-field nc="12" label="Nbre_echeance" fd="nbre_echeance"></x-field>
<button class="btn btn-sm btn-danger"  wire:click="updateCredit()">Enregistrer</button>

</div></div>