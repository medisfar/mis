<x-slot name="titre">Resultats</x-slot>

              <x-slot name="stitre">@include('livewire.monitoring.menu')</x-slot>
<div>
<table  class="table table-bordered">
<tr>
	<th>Description</th>
	<td>{{$resultat->description}}</td>
</tr>
</table>
<a class="btn btn-sm btn-primary" href="{{route('monitoring.resultats')}}">Liste</a>
<a class="btn btn-sm btn-primary" href="{{route('monitoring.resultats.edit',$resultat->id)}}">Modifier</a>
 <button  class="btn btn-sm btn-danger" wire:click="destroyResultat({{$resultat->id}})">Supprimer</button>  
</div>