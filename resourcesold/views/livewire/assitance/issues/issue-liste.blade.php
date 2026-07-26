<x-slot name="titre">Issues</x-slot>

              <x-slot name="stitre">@include('livewire.assitance.menu')</x-slot>
<div>
<button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Ajouter', 
content: {
type: 'component',
 name: 'assitance.issues.issue-add',
key: {{ rand(0,1000) }},
params: {}
 }
})">Ajouter</button><br><br><input type="text" wire:model.live="search"/><div class="table-responsive">
<table  class="table table-bordered table-striped">
<tr>
	<th>User</th>
	<th>Title</th>
	<th>Description</th>
	<th>Priority</th>
	<th>Status</th>
	<th>Resolved_at</th>
	<th>Resolution_summary</th>
<th></th></tr>
@foreach($issues as $item)
<tr>
	<td>{{$item->User->name??''}}</td>
	<td>{{$item->title}}</td>
	<td>{{$item->description}}</td>
	<td>{{$item->priority}}</td>
	<td>{{$item->status}}</td>
	<td>{{$item->resolved_at}}</td>
	<td>{{$item->resolution_summary}}</td>
<td><button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Modifier', 
content: {
type: 'component',
 name: 'assitance.issues.issue-edit',
key: {{ rand(0,1000) }},
params: {id:{{$item->id}}}
 }
})">Modifier</button> <button  class="btn btn-sm btn-danger" wire:confirm="êtes-vous sûr de vouloir supprimer" wire:click="destroyIssue({{$item->id}})">Supprimer</button>  
</td>
</tr>
@endforeach
</table></div>
{{$issues->links()}}
    
</div>