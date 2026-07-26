<x-slot name="titre">Sites</x-slot>

              <x-slot name="stitre">@include('livewire.projet.menu')</x-slot>
<div>
<table  class="table table-bordered">
<tr>
	<th>Nom</th>
	<td>{{$site->nom}}</td>
</tr>
<tr>
	<th>Type_point_focal</th>
	<td>{{$site->type_point_focal}}</td>
</tr>
<tr>
	<th>Nom_point_focal</th>
	<td>{{$site->nom_point_focal}}</td>
</tr>
<tr>
	<th>Localite</th>
	<td>{{$site->localite->nom_localite??''}}</td>
	<td>{{$site->localite_id}}</td>
</tr>
<tr>
	<th>Lattitude</th>
	<td>{{$site->lattitude}}</td>
</tr>
<tr>
	<th>Longitude</th>
	<td>{{$site->longitude}}</td>
</tr>
</table>
<a class="btn btn-sm btn-primary" href="{{route('projet.sites')}}">Liste</a>
<a class="btn btn-sm btn-primary" href="{{route('projet.sites.edit',$site->id)}}">Modifier</a>
 <button  class="btn btn-sm btn-danger" wire:click="destroySite({{$site->id}})">Supprimer</button>  
</div>