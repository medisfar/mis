<x-slot name="titre">Taches</x-slot>

              <x-slot name="stitre">@include('livewire.projet.menu')</x-slot>
<div>

@include('livewire.errors')
<div class="row">
      @php $en=false; @endphp
    @if(session()->get('pid',-1)!=-1)
     @php 
        $en=true;
        $pid=session()->get('pid');
      @endphp
     @else 
      @php 
        $en=false;
      @endphp
     @endif
    <x-select nc="6" label="Projet" fd="pid" :options="\App\Models\Projet::tab()" disabled="{{$en}}"></x-select>

<x-select nc="6" label="Composante" fd="composante_id" 
:options="\App\Models\Composante::where('projet_id',$pid)->pluck('code','id')"></x-select>
<x-select nc="12" label="Activite" fd="activite_id" :options="\App\Models\Activite::where('composante_id',$composante_id)->pluck('activite','id')"></x-select>
@if($activite_id)
<x-select nc="12" label="Site" fd="site_id" :options="\App\Models\Activite::find($activite_id)->sites->pluck('nom','id')??[]"></x-select>
@endif

<x-field nc="12" label="Tache" fd="tache"></x-field>
<x-field nc="3" label="Date_debut" fd="date_debut"></x-field>

<x-field nc="3" label="Date_fin" fd="date_fin"></x-field>
<x-field nc="3" label="Completed" fd="completed"></x-field>
<button class="btn btn-sm btn-success"  wire:click="storeTache()">Enregistrer</button>

</div></div>