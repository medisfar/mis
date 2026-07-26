<x-slot name="titre">Albums</x-slot>

              
<div>
<button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Ajouter', 
content: {
type: 'component',
 name: 'projet.albums.album-add',
key: {{ rand(0,1000) }},
params: {}
 }
})">Ajouter</button><br><br><input type="text" wire:model.live="search"/><div class="table-responsive">
<table  class="table table-bordered table-striped">
<tr>
	<th>Projet</th>
	<th>Titre</th>
	<th>Date_photos</th>
<th></th></tr>
@foreach($albums as $item)
<tr>
	<td>{{$item->Projet->libelle??''}}</td>
	<td>{{$item->titre}}</td>
	<td>{{$item->date_photos}}</td>
<td> <a href="{{route('projet.albums.show',$item->id)}}" class="btn btn-sm btn-success">show</a>
</td>
</tr>
@endforeach
</table></div>
{{$albums->links()}}
    
</div>