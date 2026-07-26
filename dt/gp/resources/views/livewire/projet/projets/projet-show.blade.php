<x-slot name="titre">Projets</x-slot>

              <x-slot name="stitre">Show des projets</x-slot>
<div>
<table  class="table table-bordered">
<tr>
	<th>Code</th>
	<td>{{$projet->code}}</td>
</tr>
<tr>
	<th>Nom projet</th>
	<td>{{$projet->nom_projet}}</td>
</tr>
<tr>
	<th>Budget</th>
	<td>{{$projet->budget}}</td>
</tr>
<tr>
	<th>Date debut</th>
	<td>{{$projet->date_debut}}</td>
</tr>
<tr>
	<th>Date fin</th>
	<td>{{$projet->date_fin}}</td>
</tr>
<tr>
	<th>Statut</th>
	<td>{{$projet->statut}}</td>
</tr>
</table>
<a class="btn btn-sm btn-primary" href="{{route('projet.projets')}}">Liste</a>
<a class="btn btn-sm btn-primary" href="{{route('projet.projets.edit',$projet->id)}}">Modifier</a>
 <button  class="btn btn-sm btn-danger" wire:click="destroyProjet">Supprimer</button>  
</div>