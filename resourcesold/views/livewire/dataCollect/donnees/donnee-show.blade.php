<x-slot name="titre">Donnees</x-slot>

              <x-slot name="stitre">@include('livewire.dataCollect.menu')</x-slot>
<div>
<table  class="table table-bordered">
<tr>
	<th>Site</th>
	<td>{{$donnee->site->nom??''}}</td>
	<td>{{$donnee->site_id}}</td>
</tr>
<tr>
	<th>Groupement</th>
	<td>{{$donnee->groupement->projet_id??''}}</td>
	<td>{{$donnee->groupement_id}}</td>
</tr>
<tr>
	<th>Session</th>
	<td>{{$donnee->session->user_id??''}}</td>
	<td>{{$donnee->session_id}}</td>
</tr>
<tr>
	<th>Membre</th>
	<td>{{$donnee->membre->menage_id??''}}</td>
	<td>{{$donnee->membre_id}}</td>
</tr>
<tr>
	<th>Metadonnees</th>
	<td>{{$donnee->metadonnees}}</td>
</tr>
</table>
<a class="btn btn-sm btn-primary" href="{{route('dataCollect.donnees')}}">Liste</a>
<a class="btn btn-sm btn-primary" href="{{route('dataCollect.donnees.edit',$donnee->id)}}">Modifier</a>
 <button  class="btn btn-sm btn-danger" wire:click="destroyDonnee({{$donnee->id}})">Supprimer</button>  
</div>