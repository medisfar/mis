<x-slot name="titre">Souscomposantes</x-slot>

              <x-slot name="stitre">@include('livewire.projet.menu')</x-slot>
<div>
<table  class="table table-bordered">
<tr>
	<th>Code</th>
	<td>{{$souscomposante->code}}</td>
</tr>
<tr>
	<th>Description</th>
	<td>{{$souscomposante->description}}</td>
</tr>
<tr>
	<th>Composante</th>
	<td>{{$souscomposante->composante->code??''}}</td>
</tr>
 



</table>
<a class="btn btn-sm btn-primary" href="{{route('projet.projets.show',[$souscomposante->composante->projet_id,'tab'=>'composantes'])}}">Liste</a>
<a class="btn btn-sm btn-primary" href="{{route('projet.souscomposantes.edit',$souscomposante->id)}}"><i class="fas fa-edit"></i></button>
 <button  class="btn btn-sm btn-danger" wire:click="destroySouscomposante({{$souscomposante->id}})"><i class="fas fa-trash"></i></button>  
</div>