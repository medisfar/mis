<x-slot name="titre">Secteurs</x-slot>

              <x-slot name="stitre">@include('livewire.monitoring.menu')</x-slot>
<div>
<table  class="table table-bordered">
<tr>
	<th>Nom_secteur</th>
	<td>{{$secteur->nom_secteur}}</td>
</tr>
<tr>
	<th>Mission</th>
	<td>{{$secteur->mission->libelle??''}}</td>
	<td>{{$secteur->mission_id}}</td>
</tr>
</table>
<a class="btn btn-sm btn-primary" href="{{route('monitoring.secteurs')}}">Liste</a>
<a class="btn btn-sm btn-primary" href="{{route('monitoring.secteurs.edit',$secteur->id)}}">Modifier</a>
 <button  class="btn btn-sm btn-danger" wire:click="destroySecteur({{$secteur->id}})">Supprimer</button>  
</div>