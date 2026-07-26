<x-slot name="titre">Issues</x-slot>

           
<div>
<button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Ajouter', 
content: {
type: 'component',
 name: 'assistance.issues.issue-add',
key: {{ rand(0,1000) }},
params: {}
 }
})">Ajouter</button><br><br><input type="text" wire:model.live="search"/><div class="table-responsive">
<table  class="table table-bordered table-striped">
<tr>
	<th>User</th>
	<th width="40%">Title</th>
	
	<th>Priority</th>
	<th>Status</th>

<th></th></tr>
@foreach($issues as $item)
<tr>
	<td>{{$item->User->name??''}}<br><span style="color:gray">{{$item->created_at??''}}</span>
	</td>
	<td>{{$item->title}}</td>

	<td>{{$item->priority}}</td>
	<td>{{$item->status}}</td>
<td>@if($item->image_before!=null)<a target="_blank" href="{{url('/').'/'.$item->image_before}}">voir</a>@endif</td>	

<td>
    
    <a class="btn btn-sm btn-success" href="{{route('assistance.issues.show',$item->id)}}"><i class="fas fa-eye"></i></a>
    <button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Modifier', 
content: {
type: 'component',
 name: 'assistance.issues.issue-edit',
key: {{ rand(0,1000) }},
params: {id:{{$item->id}}}
 }
})"><i class="fas fa-eye"></i></button> <button  class="btn btn-sm btn-danger" wire:confirm="êtes-vous sûr de vouloir supprimer" wire:click="destroyIssue({{$item->id}})"><i class="fas fa-trash"></i></button>  
</td>
</tr>
@endforeach
</table></div>
{{$issues->links()}}
    
</div>