<x-slot name="titre">Composantes</x-slot>

              <x-slot name="stitre">@include('livewire.monitoring.menu')</x-slot>
<div>
<table  class="table table-bordered">
<tr>
	<th>Code</th>
	<td>{{$composante->code}}</td>
</tr>
<tr>
	<th>Description</th>
	<td>{{$composante->description}}</td>
</tr>
<tr>
	<th>Projet</th>
	<td>{{$composante->projet->code??''}}</td>
	<td>{{$composante->projet_id}}</td>
</tr>
</table>
<a class="btn btn-sm btn-primary" href="{{route('monitoring.composantes')}}">Liste</a>
<a class="btn btn-sm btn-primary" href="{{route('monitoring.composantes.edit',$composante->id)}}"><i class="fas fa-edit"></i></button>
 <button  class="btn btn-sm btn-danger" wire:click="destroyComposante({{$composante->id}})"><i class="fas fa-trash"></i></button>  
</div>