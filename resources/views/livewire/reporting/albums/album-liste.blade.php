<x-slot name="titre">Albums</x-slot>

              <x-slot name="stitre">@include('livewire.reporting.menu')</x-slot>
<div>
<button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Ajouter', 
content: {
type: 'component',
 name: 'reporting.albums.album-add',
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
	<td>{{$item->Projet->code??''}}</td>
	<td>{{$item->titre}}</td>
	<td>{{$item->date_photos}}</td>
	<td> <a href="{{route('reporting.albums.show',$item->id)}}" class="btn btn-sm btn-success">show</a>
</td>
<td><button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Modifier', 
content: {
type: 'component',
 name: 'reporting.albums.album-edit',
key: {{ rand(0,1000) }},
params: {id:{{$item->id}}}
 }
})">Modifier</button> <button  class="btn btn-sm btn-danger" wire:confirm="êtes-vous sûr de vouloir supprimer" wire:click="destroyAlbum({{$item->id}})">Supprimer</button>  
</td>
</tr>
@endforeach
</table></div>
{{$albums->links()}}
    
</div>