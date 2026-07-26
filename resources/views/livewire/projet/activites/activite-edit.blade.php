<x-slot name="titre">Activites</x-slot>

              <x-slot name="stitre">@include('livewire.projet.menu')</x-slot>
<div>

@include('livewire.errors')
<div class="row">
     @php $en=false; @endphp
    @if(session()->get('pid',-1)!=-1)
     @php 
        $en=true;
        $this->pid=session()->get('pid');
      @endphp
     @else 
      @php 
        $en=false;
      @endphp
     @endif
   

<x-select nc="4" label="Projet" fd="pid" :options="\App\Models\Projet::tab()" disabled="{{$en}}"></x-select>

<x-select nc="4" label="Composante" fd="composante_id" :options="\App\Models\Composante::where('projet_id',session()->get('pid'))->pluck('code','id')"></x-select>

<x-select nc="4" label="Sous_composante" fd="sous_composante_id" :options="\App\Models\Souscomposante::where('composante_id',$composante_id)->pluck('code','id')"></x-select>

<x-field nc="12" label="Activite" fd="activite"></x-field>
<x-field nc="3" label="Date_debut" fd="date_debut"></x-field>
<x-field nc="3" label="Date_fin" fd="date_fin"></x-field>
<x-field nc="3" label="Budget" fd="budget"></x-field>

<x-select nc="3" label="Statut" fd="statut" :options="\App\Models\Activite::statuts()"></x-select>
<button class="btn btn-sm btn-success"  wire:click="updateActivite()">Enregistrer</button>

</div></div>