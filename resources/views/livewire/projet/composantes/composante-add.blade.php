<div>
@include('livewire.errors')
<div class="row">
   @php $en=false; @endphp
	@if(session()->get('pid',-1)!=-1)
	 @php 
	    $en=true;
        $this->projet_id=session()->get('pid');
      @endphp
	 @else 
	  @php 
	    $en=false;
	  @endphp
	 @endif
<x-select nc="3" label="Projet" fd="projet_id" :options="\App\Models\Projet::tab()" disabled="{{$en}}"></x-select>
<x-field nc="3" label="Code" fd="code"></x-field>
<x-field nc="6" label="Description" fd="description"></x-field>
<x-field nc="3" label="Budget" fd="budget"></x-field>


<button class="btn btn-sm btn-success"  wire:click="storeComposante()">Ajouter</button>

</div></div>