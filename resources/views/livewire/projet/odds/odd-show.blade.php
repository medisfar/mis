<x-slot name="titre">Odds</x-slot>

              <x-slot name="stitre">@include('livewire.projet.menu')</x-slot>
<div>
<table  class="table table-bordered">
<tr>
	<th>Nom</th>
	<td>{{$odd->nom}}</td>
</tr>
</table>
<a class="btn btn-sm btn-primary" href="{{route('projet.odds')}}">Liste</a>
<a class="btn btn-sm btn-primary" href="{{route('projet.odds.edit',$odd->id)}}">Modifier</a>
 <button  class="btn btn-sm btn-danger" wire:click="destroyOdd({{$odd->id}})">Supprimer</button>  
</div>