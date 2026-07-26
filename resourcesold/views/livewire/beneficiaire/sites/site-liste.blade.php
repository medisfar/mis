<x-slot name="titre">Sites</x-slot>

             
<div>
<button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Ajouter', 
content: {
type: 'component',
 name: 'beneficiaire.sites.site-add',
key: {{ rand(0,1000) }},
params: {}
 }
})">Ajouter</button><br><br><input type="text" wire:model.live="search"/><div class="table-responsive">
<table  class="table table-bordered table-striped">
<tr>
	<th>Nom</th>
	<th>Activite</th>
<th></th></tr>
@foreach($sites as $item)
<tr>
	<td>{{$item->nom}}</td>
	<td>{{$item->Activite->activite??''}}</td>
<td><button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Modifier', 
content: {
type: 'component',
 name: 'beneficiaire.sites.site-edit',
key: {{ rand(0,1000) }},
params: {id:{{$item->id}}}
 }
})">Modifier</button> <button  class="btn btn-sm btn-danger" wire:confirm="êtes-vous sûr de vouloir supprimer" wire:click="destroySite({{$item->id}})">Supprimer</button>  
</td>
</tr>
@endforeach
</table></div>
{{$sites->links()}}
    
</div>