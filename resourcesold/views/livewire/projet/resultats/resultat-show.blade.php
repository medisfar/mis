<x-slot name="titre">Resultats</x-slot>

              <x-slot name="stitre">@include('livewire.projet.menu')</x-slot>
<div>
<table  class="table table-bordered">
<tr>
	<th>Projet</th>
	<td>{{$resultat->projet->code??''}}</td>
	<td>{{$resultat->projet_id}}</td>
</tr>
<tr>
	<th>Description</th>
	<td>{{$resultat->description}}</td>
</tr>
</table>
<a class="btn btn-sm btn-primary" href="{{route('projet.resultats')}}">Liste</a>
<a class="btn btn-sm btn-primary" href="{{route('projet.resultats.edit',$resultat->id)}}">Modifier</a>
 <button  class="btn btn-sm btn-danger" wire:click="destroyResultat({{$resultat->id}})">Supprimer</button>  
</div>