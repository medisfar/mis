<x-slot name="titre">Membres</x-slot>

             
<div>
<button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Ajouter', 
content: {
type: 'component',
 name: 'beneficiaire.membres.membre-add',
key: {{ rand(0,1000) }},
params: {}
 }
})">Ajouter</button><br><br><input type="text" wire:model.live="search"/><div class="table-responsive">
<table  class="table table-bordered table-striped">
<tr>
	<th>Menage</th>
	<th>Genre</th>
	<th>Nom</th>
	<th>Date_naissance</th>
	<th>Lien_parente</th>
	<th>Enceinte</th>
<th></th></tr>
@foreach($membres as $item)
<tr>
	<td>{{$item->Menage->toit_id??''}}</td>
	<td>{{$item->genre}}</td>
	<td>{{$item->nom}}</td>
	<td>{{$item->date_naissance}}</td>
	<td>{{$item->lien_parente}}</td>
	<td>{{$item->enceinte}}</td>
<td><button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Modifier', 
content: {
type: 'component',
 name: 'beneficiaire.membres.membre-edit',
key: {{ rand(0,1000) }},
params: {id:{{$item->id}}}
 }
})"><i class="fas fa-eye"></i></button> <button  class="btn btn-sm btn-danger" wire:confirm="êtes-vous sûr de vouloir supprimer" wire:click="destroyMembre({{$item->id}})"><i class="fas fa-trash"></i></button>  
</td>
</tr>
@endforeach
</table></div>
{{$membres->links()}}
    
</div>