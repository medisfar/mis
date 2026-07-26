

              <x-slot name="stitre">@include('livewire.datacollect.menu')</x-slot>
<div>
<button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Ajouter', 
content: {
type: 'component',
 name: 'datacollect.sessions.session-add',
key: {{ rand(0,1000) }},
params: {}
 }
})">Ajouter</button><br><br><input type="text" wire:model.live="search"/><div class="table-responsive">
<table  class="table table-bordered table-striped">
<tr>
	<th>User</th>
	<th>Ip_address</th>
	<th>User_agent</th>
	<th>Payload</th>
	<th>Last_activity</th>
<th></th></tr>
@foreach($sessions as $item)
<tr>
	<td>{{$item->User->name??''}}</td>
	<td>{{$item->ip_address}}</td>
	<td>{{$item->user_agent}}</td>
	<td>{{$item->payload}}</td>
	<td>{{$item->last_activity}}</td>
<td><button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Modifier', 
content: {
type: 'component',
 name: 'datacollect.sessions.session-edit',
key: {{ rand(0,1000) }},
params: {id:{{$item->id}}}
 }
})">Modifier</button> <button  class="btn btn-sm btn-danger" wire:confirm="êtes-vous sûr de vouloir supprimer" wire:click="destroySession({{$item->id}})">Supprimer</button>  
</td>
</tr>
@endforeach
</table></div>
{{$sessions->links()}}
    
</div>