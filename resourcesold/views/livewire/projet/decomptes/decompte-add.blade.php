<x-slot name="titre">Decomptes</x-slot>

              <x-slot name="stitre">@include('livewire.projet.menu')</x-slot>
<div>

@include('livewire.errors')
<div class="row">
    @if($activite_id==0)
<x-select nc="12" label="Activite" fd="activite_id" :options="\App\Models\Activite::tab()"></x-select>
@endif
<x-field nc="12" label="Date_previsionnelle" fd="date_previsionnelle"></x-field>
<x-field nc="12" label="Montant" fd="montant"></x-field>
<x-field nc="12" label="Date_effective" fd="date_effective"></x-field>
<button class="btn btn-sm btn-success"  wire:click="storeDecompte()">Enregistrer</button>

</div></div>