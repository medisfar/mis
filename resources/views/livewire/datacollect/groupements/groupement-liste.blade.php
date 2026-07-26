<x-slot name="titre">Groupements</x-slot>

              <x-slot name="stitre">@include('livewire.datacollect.menu')</x-slot>
<div>
<button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Ajouter', 
content: {
type: 'component',
 name: 'datacollect.groupements.groupement-add',
key: {{ rand(0,1000) }},
params: {}
 }
})">Ajouter</button><br><br><input type="text" wire:model.live="search"/><div class="table-responsive">
<table  class="table table-bordered table-striped">
<tr>
	<th>Projet</th>
	<th>Nom_groupe</th>
	<th>Site</th>
	<th>Statut</th>
<th></th></tr>
@foreach($groupements as $item)
<tr>
	<td>{{$item->Projet->code??''}}</td>
	<td>{{$item->nom_groupe}}</td>
	<td>{{$item->Site->projet_id??''}}</td>
	<td>{{$item->statut}}</td>
<td><button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Modifier', 
content: {
type: 'component',
 name: 'datacollect.groupements.groupement-show',
key: {{ rand(0,1000) }},
params: {id:{{$item->id}}}
 }
})">show</button> 
</td>
</tr>
@endforeach
</table></div>
{{$groupements->links()}}
    
</div>