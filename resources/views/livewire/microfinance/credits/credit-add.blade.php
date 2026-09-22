<x-slot name="titre">Credits</x-slot>

              <x-slot name="stitre">@include('livewire.microfinance.menu')</x-slot>
<div>

@include('livewire.errors')
<div class="row">
<x-select nc="12" label="Foyer" fd="foyer_id" :options="$foyers"></x-select>
<x-select nc="12" label="Membre" fd="membre_id" :options="$membres" :disabled="!$foyer_id"></x-select>
<x-field nc="12" label="Date_octroi" fd="date_octroi"></x-field>
<x-field nc="12" label="Date_premiere_echeance" fd="date_premiere_echeance"></x-field>
<x-field nc="12" label="Montant_echeance" fd="montant_echeance"></x-field>
<x-field nc="12" label="Nbre_echeance" fd="nbre_echeance"></x-field>
<x-field nc="12" label="Termine" fd="termine"></x-field>
<button class="btn btn-sm btn-success"  wire:click="storeCredit()">Enregistrer</button>

</div></div>
