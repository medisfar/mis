<x-slot name="titre">Etudes</x-slot>

              <x-slot name="stitre">@include('livewire.etude.menu')</x-slot>
<div>
<table  class="table entete">
<tr>
	<th>Projet</th>


	<th>Categorie</th>


	<th>Nom</th>

</tr><tr>

	<td>{{$etude->projet->libelle??''}}</td>


	<td>{{$etude->categorie}}</td>


	<td>{{$etude->nom}}</td>
</tr>
<tr>
	<th>Objectif</th></tr>
</tr>
	<tr></tr>
	<td colspan="3">{{$etude->objectif}}</td>
</tr>
<tr>
	<th>Methologie</th></tr>
<tr>
	
	<td colspan="3">{{$etude->methologie}}</td>
</tr>
<tr>
	<th> Resultats_principaux</th></tr>
<tr>
	<td colspan="3">{{$etude->resultats_principaux}}</td>
</tr>
<tr>
	<th>Reommendations_cles</th></tr>
<tr>
	<td colspan="3">{{$etude->reommendations_cles}}</td>
</tr>
<tr>
	<th>Periode</th></tr>
<tr>
	<td>{{$etude->date_debut}} {{$etude->date_fin}}</td>
</tr>
<tr>
	<th>Statut</th>	<th>Zones</th>	<th>Partenaire</th></tr>
<tr>
	<td>{{$etude->lestatut}}</td>


	<td>{{$etude->Zones}}</td>


	<td>{{$etude->partenaire}}</td>
</tr>
<tr>
	<th>Lecons_apprises</th></tr>
<tr>
	<td colspan="3">{{$etude->lecons_apprises}}</td>
</tr>
</table>
<a class="btn btn-sm btn-primary" href="{{route('etude.etudes')}}">Liste</a>
<a class="btn btn-sm btn-primary" href="{{route('etude.etudes.edit',$etude->id)}}">Modifier</a>
 <button  class="btn btn-sm btn-danger" wire:click="destroyEtude({{$etude->id}})">Supprimer</button>  
</div>