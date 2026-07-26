<x-slot name="titre">Sites</x-slot>

              <x-slot name="stitre">@include('livewire.projet.menu')</x-slot>
<div>
<button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Ajouter', 
content: {
type: 'component',
 name: 'projet.sites.site-add',
key: {{ rand(0,1000) }},
params: {}
 }
})">Ajouter</button><br><br><input type="text" wire:model.live="search"/><div class="table-responsive">
<table  class="table table-bordered table-striped">
<tr>
	<th>Nom</th>
	<th>Type_point_focal</th>
	<th>Nom_point_focal</th>
	<th>Localite</th>
	<th>Lattitude</th>
	<th>Longitude</th>
<th></th></tr>
@foreach($sites as $item)
<tr>
	<td>{{$item->nom}}</td>
	<td>{{$item->type_point_focal}}</td>
	<td>{{$item->nom_point_focal}}</td>
	<td>{{$item->Localite->nom_localite??''}}</td>
	<td>{{$item->lattitude}}</td>
	<td>{{$item->longitude}}</td>
<td><button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Modifier', 
content: {
type: 'component',
 name: 'projet.sites.site-edit',
key: {{ rand(0,1000) }},
params: {id:{{$item->id}}}
 }
})"><i class="fas fa-eye"></i></button> <button  class="btn btn-sm btn-danger" wire:confirm="êtes-vous sûr de vouloir supprimer" wire:click="destroySite({{$item->id}})"><i class="fas fa-trash"></i></button>  
</td>
</tr>
@endforeach
</table></div>
{{$sites->links()}}
    
</div>