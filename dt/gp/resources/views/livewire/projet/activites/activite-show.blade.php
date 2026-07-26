<x-slot name="titre">Activites</x-slot>

              <x-slot name="stitre">@include('livewire.projet.menu')</x-slot>
<div>
<table  class="table table-bordered">
<tr>
	<th>Nom_activite</th>
	<td>{{$activite->nom_activite}}</td>
</tr>
<tr>
	<th>Composante</th>
	<td>{{$activite->composante->code??''}}</td>
	
</tr>
<tr>
	<th>Sous_composante</th>
	<td>{{$activite->souscomposante->code??''}}</td>
	
</tr>
<tr>
	<th>Date_debut</th>
	<td>{{$activite->date_debut}}</td>
</tr>
<tr>
	<th>Date_fin</th>
	<td>{{$activite->date_fin}}</td>
</tr>
<tr>
	<th>Completed</th>
	<td>{{$activite->completed}}</td>
</tr>
</table>
<a class="btn btn-sm btn-primary" href="{{route('projet.activites')}}">Liste</a>
<a class="btn btn-sm btn-primary" href="{{route('projet.activites.edit',$activite->id)}}">Modifier</a>
 <button  class="btn btn-sm btn-danger" wire:click="destroyActivite({{$activite->id}})">Supprimer</button>  
</div>