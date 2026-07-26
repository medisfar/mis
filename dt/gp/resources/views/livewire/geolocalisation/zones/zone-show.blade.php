<x-slot name="titre">Zones</x-slot>

              <x-slot name="stitre">Show des zones</x-slot>
<div>
<table  class="table table-bordered">
<tr>
	<th>Nom zone</th>
	<td>{{$zone->nom_zone}}</td>
</tr>
<tr>
	<th>Localite</th>
	<td>{{$zone->localite->nom_localite??''}}</td>
</tr>
<tr>
	<th>Longitude</th>
	<td>{{$zone->longitude}}</td>
</tr>
<tr>
	<th>Lattitude</th>
	<td>{{$zone->lattitude}}</td>
</tr>
</table>
<a class="btn btn-sm btn-primary" href="{{route('geolocalisation.zones')}}">Liste</a>
<a class="btn btn-sm btn-primary" href="{{route('geolocalisation.zones.edit',$zone->id)}}">Modifier</a>
 <button  class="btn btn-sm btn-danger" wire:click="destroyZone">Supprimer</button>  
</div>