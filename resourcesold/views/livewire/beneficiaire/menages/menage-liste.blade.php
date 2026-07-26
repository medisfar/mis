<x-slot name="titre">Menages</x-slot>

           
<div>
<button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Ajouter', 
content: {
type: 'component',
 name: 'beneficiaire.menages.menage-add',
key: {{ rand(0,1000) }},
params: {}
 }
})">Ajouter</button><br><br><input type="text" wire:model.live="search"/><div class="table-responsive">
<table  class="table table-bordered table-striped">
<tr>
	<th>Toit</th>
	<th>Chef</th>
	<th>Localite</th>
<th></th></tr>
@foreach($menages as $item)
<tr>
	<td>{{$item->Toit->adresse??''}}</td>
	<td>{{$item->chef}}</td>
	<td>{{$item->localite->nom_localite??''}}</td>
<td><button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Modifier', 
content: {
type: 'component',
 name: 'beneficiaire.menages.menage-edit',
key: {{ rand(0,1000) }},
params: {id:{{$item->id}}}
 }
})">Modifier</button> <button  class="btn btn-sm btn-danger" wire:confirm="êtes-vous sûr de vouloir supprimer" wire:click="destroyMenage({{$item->id}})">Supprimer</button>  
</td>
</tr>
@endforeach
</table></div>
{{$menages->links()}}
    
</div>