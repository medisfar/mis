<x-slot name="titre">Zones</x-slot>

              <x-slot name="stitre">Liste des zones</x-slot>
<div>

<a class="btn btn-sm btn-success" href="{{route('geolocalisation.zones.add')}}">Ajouter</a>
<br><br>
<input type="text" wire:model="search"/>
        <div class="table-responsive">
        <table  class="table table-bordered table-striped">
<tr>
	<th>Nom zone</th>
	<th>Localite</th>
	<th>Longitude</th>
	<th>Lattitude</th>
<th></th></tr>
@foreach($zones as $item)
<tr>
	<td>{{$item->nom_zone}}</td>
	<td>{{$item->Localite->nom_localite??''}}</td>
	<td>{{$item->longitude}}</td>
	<td>{{$item->lattitude}}</td>
<td><a class="btn btn-sm btn-primary"  href="{{route('geolocalisation.zones.show',$item->id)}}">Voir</a>
</td>
</tr>
@endforeach
</table></div>
{{$zones->links()}}
    
</div>