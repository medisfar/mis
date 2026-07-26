<x-slot name="titre">Etudes</x-slot>

              <x-slot name="stitre">@include('livewire.monitoring.menu')</x-slot>
<div>
<table  class="table table-bordered">
<tr>
	<th>Projet</th>
	<td>{{$etude->projet->code??''}}</td>
	<td>{{$etude->projet_id}}</td>
</tr>
<tr>
	<th>Categorie</th>
	<td>{{$etude->categorie}}</td>
</tr>
<tr>
	<th>Nom</th>
	<td>{{$etude->nom}}</td>
</tr>
<tr>
	<th>Objectif</th>
	<td>{{$etude->objectif}}</td>
</tr>
<tr>
	<th>Methologie</th>
	<td>{{$etude->methologie}}</td>
</tr>
<tr>
	<th>Resultats_principaux</th>
	<td>{{$etude->resultats_principaux}}</td>
</tr>
<tr>
	<th>Reommendations_cles</th>
	<td>{{$etude->reommendations_cles}}</td>
</tr>
<tr>
	<th>Date_debut</th>
	<td>{{$etude->date_debut}}</td>
</tr>
<tr>
	<th>Date_fin</th>
	<td>{{$etude->date_fin}}</td>
</tr>
<tr>
	<th>Statut</th>
	<td>{{$etude->statut}}</td>
</tr>
<tr>
	<th>Zones</th>
	<td>{{$etude->Zones}}</td>
</tr>
<tr>
	<th>Partenaire</th>
	<td>{{$etude->partenaire}}</td>
</tr>
<tr>
	<th>Lecons_apprises</th>
	<td>{{$etude->lecons_apprises}}</td>
</tr>
</table>
<a class="btn btn-sm btn-primary" href="{{route('monitoring.etudes')}}">Liste</a>
<a class="btn btn-sm btn-primary" href="{{route('monitoring.etudes.edit',$etude->id)}}">Modifier</a>
 <button  class="btn btn-sm btn-danger" wire:click="destroyEtude({{$etude->id}})">Supprimer</button>  
</div>