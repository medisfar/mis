<x-slot name="titre">Decomptes</x-slot>

              <x-slot name="stitre">@include('livewire.projet.menu')</x-slot>
<div>
@include('livewire.errors')
<div class="row">
  
<x-select nc="6" label="Composante" fd="cpid" :options="\App\Models\Composante::where('projet_id',session()->get('pid'))->pluck('code','id')">
</x-select>

<x-select nc="6" label="Activite" fd="activite_id" :options="\App\Models\Activite::where('composante_id',$cpid)->pluck('activite','id')">
</x-select>

<x-select nc="6" label="Tache" fd="tache_id" :options="\App\Models\Tache::where('activite_id',$activite_id)->pluck('tache','id')"></x-select>
@if($activite_id)
<x-select nc="6" label="Site" fd="site_id" :options="\App\Models\Activite::find($activite_id)->sites->pluck('nom','id')??[]"></x-select>
@endif
<x-field nc="12" label="Libelle" fd="libelle"></x-field>
<x-field nc="6" label="Montant" fd="montant"></x-field>
<x-field nc="6" label="Date_effective" fd="date_effective"></x-field>
<button class="btn btn-sm btn-success"  wire:click="storeDecompte()">Enregistrer</button>

</div></div>