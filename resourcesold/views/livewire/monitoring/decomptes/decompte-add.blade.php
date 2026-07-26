<x-slot name="titre">Decomptes</x-slot>

              <x-slot name="stitre">@include('livewire.monitoring.menu')</x-slot>
<div>

@include('livewire.errors')
<div class="row">
    
    <x-select nc="12" label="Composante" fd="pid" :options="\App\Models\Composante::where('projet_id',session()->get('pid'))->pluck('description','id')"></x-select>

<x-select nc="12" label="Activite" fd="activite_id" :options="\App\Models\Activite::where('composante_id',$pid)->pluck('activite','id')"></x-select>
@if($activite_id)
<x-select nc="12" label="Site" fd="site_id" :options="\App\Models\Activite::find($activite_id)->sites->pluck('nom','id')??[]"></x-select>
@endif
<x-field nc="12" label="Montant" fd="montant"></x-field>
<x-field nc="12" label="Date_effective" fd="date_effective"></x-field>
<button class="btn btn-sm btn-success"  wire:click="storeDecompte()">Enregistrer</button>

</div></div>