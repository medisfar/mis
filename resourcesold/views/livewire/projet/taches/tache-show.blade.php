<x-slot name="titre">Taches</x-slot>

              <x-slot name="stitre">@include('livewire.projet.menu')</x-slot>
<div>
<table  class="table table-bordered">
<tr>
	<th>Tache</th>
	<td>{{$latache->tache}}</td>
</tr>
<tr>
	<th>Activite</th>
	<td>{{$latache->activite->activite??''}}</td>
	
</tr>
<tr>
	<th>Date_debut</th>
	<td>{{$latache->date_debut}}</td>
</tr>
<tr>
	<th>Date_fin</th>
	<td>{{$latache->date_fin}}</td>
</tr>
<tr>
	<th>Completed</th>
	<td>{{$latache->completed}}</td>
</tr>
</table>
<a class="btn btn-sm btn-primary" href="{{route('projet.taches')}}">Liste</a>
<a class="btn btn-sm btn-primary" href="{{route('projet.taches.edit',$latache->id)}}">Modifier</a>
 <button  class="btn btn-sm btn-danger" wire:click="destroyTache({{$latache->id}})">Supprimer</button>  
</div>