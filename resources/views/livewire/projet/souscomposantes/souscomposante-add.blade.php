<x-slot name="titre">Souscomposantes</x-slot>

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
    <x-select nc="6" label="Projet" fd="pid" :options="\App\Models\Projet::tab()" disabled="{{$en}}"></x-select>

<x-select nc="6" label="Composante" fd="composante_id" 
:options="\App\Models\Composante::where('projet_id',session()->get('pid'))->pluck('code','id')"></x-select>
<x-field nc="3" label="Code" fd="code"></x-field>
<x-field nc="9" label="Description" fd="description"></x-field>

<button class="btn btn-sm btn-success"  wire:click="storeSouscomposante()">Enregistrer</button>

</div></div>