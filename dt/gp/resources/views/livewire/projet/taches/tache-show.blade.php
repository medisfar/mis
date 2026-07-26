<x-slot name="titre">Taches</x-slot>

              <x-slot name="stitre">@include('livewire.projet.menu')</x-slot>
<div>
<table  class="table table-bordered">
<tr>
	<th>Tache</th>
	<td>{{$tache->tache}}</td>
</tr>
<tr>
	<th>Activite</th>
	<td>{{$tache->activite->nom_activite??''}}</td>
	<td>{{$tache->activite_id}}</td>
</tr>
<tr>
	<th>Date_debut</th>
	<td>{{$tache->date_debut}}</td>
</tr>
<tr>
	<th>Date_fin</th>
	<td>{{$tache->date_fin}}</td>
</tr>
<tr>
	<th>Completed</th>
	<td>{{$tache->completed}}</td>
</tr>
</table>
<a class="btn btn-sm btn-primary" href="{{route('projet.taches')}}">Liste</a>
<a class="btn btn-sm btn-primary" href="{{route('projet.taches.edit',$tache->id)}}">Modifier</a>
 <button  class="btn btn-sm btn-danger" wire:click="destroyTache({{$tache->id}})">Supprimer</button>  
</div>