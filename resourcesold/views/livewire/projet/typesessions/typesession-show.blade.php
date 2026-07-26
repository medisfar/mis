<x-slot name="titre">Typesessions</x-slot>

              <x-slot name="stitre">@include('livewire.projet.menu')</x-slot>
<div>
<table  class="table table-bordered">
<tr>
	<th>Nom</th>
	<td>{{$typesession->nom}}</td>
</tr>
</table>
<a class="btn btn-sm btn-primary" href="{{route('projet.typesessions')}}">Liste</a>
<a class="btn btn-sm btn-primary" href="{{route('projet.typesessions.edit',$typesession->id)}}">Modifier</a>
 <button  class="btn btn-sm btn-danger" wire:click="destroyTypesession({{$typesession->id}})">Supprimer</button>  
</div>