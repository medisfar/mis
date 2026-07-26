

              <x-slot name="stitre">@include('livewire.geolocalisation.menu')</x-slot>
<div>
<button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Ajouter', 
content: {
type: 'component',
 name: 'geolocalisation.zones.zone-add',
key: {{ rand(0,1000) }},
params: {}
 }
})">Ajouter</button><br><br><input type="text" wire:model.live="search"/><div class="table-responsive">
<table  class="table table-bordered table-striped">
<tr>
	<th>Nom_zone</th>
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
<td><button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Modifier', 
content: {
type: 'component',
 name: 'geolocalisation.zones.zone-edit',
key: {{ rand(0,1000) }},
params: {id:{{$item->id}}}
 }
})">Modifier</button> <button  class="btn btn-sm btn-danger" wire:confirm="êtes-vous sûr de vouloir supprimer" wire:click="destroyZone({{$item->id}})">Supprimer</button>  
</td>
</tr>
@endforeach
</table></div>
{{$zones->links()}}
    
</div>