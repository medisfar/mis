<x-slot name="titre">Composantes</x-slot>

    
<div>
<button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Ajouter', 
content: {
type: 'component',
 name: 'monitoring.composantes.composante-add',
key: {{ rand(0,1000) }},
params: {}
 }
})">Ajouter</button><br><br><input type="text" wire:model.live="search"/><div class="table-responsive">
<table  class="table table-bordered table-striped">
<tr>
	<th>Code</th>
	<th>Description</th>
	<th>Projet</th>
<th></th></tr>
@foreach($composantes as $item)
<tr>
	<td>{{$item->code}}</td>
	<td>{{$item->description}}</td>
	<td>{{$item->Projet->libelle??''}}</td>
<td>
    <a  class=" btn btn-sm btn-info" href="{{route('composante.gantt',$item->id)}}">Gantt</a>
    
</td>
</tr>
@endforeach
</table></div>
{{$composantes->links()}}
    
</div>