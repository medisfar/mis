<x-slot name="titre">composantes</x-slot>

              <x-slot name="stitre">@include('livewire.projet.menu')</x-slot>
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
<a class="btn btn-sm btn-primary" href="{{route('projet.composantes')}}">Liste</a>
<a class="btn btn-sm btn-primary" href="{{route('projet.composantes.edit',$composante->id)}}">Modifier</a>
 <button  class="btn btn-sm btn-danger" wire:click="destroyComposante({{$composante->id}})">Supprimer</button>  
</div>