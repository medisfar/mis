<x-slot name="titre">Documents</x-slot>

              <x-slot name="stitre">@include('livewire.reporting.menu')</x-slot>
<div>
<button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Ajouter', 
content: {
type: 'component',
 name: 'reporting.documents.document-add',
key: {{ rand(0,1000) }},
params: {}
 }
})">Ajouter</button><br><br><input type="text" wire:model.live="search"/><div class="table-responsive">
<table  class="table table-bordered table-striped">
<tr>
	<th>Projet</th>
	<th>Titre</th>
	<th>Fichier</th>
<th></th></tr>
@foreach($documents as $item)
<tr>
	<td>{{$item->Projet->code??''}}</td>
	<td>{{$item->titre}}</td>
	<td><a href="{{url('/')}}/{{$item->fichier}}">voir</a></td>
<td>
    <button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Modifier', 
content: {
type: 'component',
 name: 'projet.documents.document-edit',
key: {{ rand(0,1000) }},
params: {id:{{$item->id}}}
 }
})">Modifier</button> <button  class="btn btn-sm btn-danger" wire:confirm="êtes-vous sûr de vouloir supprimer" wire:click="destroyDocument({{$item->id}})">Supprimer</button>  
</td>
</tr>
@endforeach
</table></div>
{{$documents->links()}}
    
</div>