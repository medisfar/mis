<x-slot name="titre">Issues</x-slot>

              <x-slot name="stitre">@include('livewire.assistance.menu')</x-slot>
<div>
<table  class="table table-bordered">
<tr>
	<th>User</th>
	<td>{{$issue->user->name??''}}</td>
	
<tr>
	<th>Title</th>
	<td>{{$issue->title}}</td>
</tr>
<tr>
	<th>Description</th>
	<td>{{$issue->description}}</td>
</tr>
<tr>
	<th>Priority</th>
	<td>{{$issue->priority}}</td>
</tr>
<tr>
	<th>Status</th>
	<td>{{$issue->status}}</td>
</tr>
<tr>
	<th>Resolved_at</th>
	<td>{{$issue->resolved_at}}</td>
</tr>
<tr>
	<th>Resolution_summary</th>
	<td>{{$issue->resolution_summary}}</td>
</tr>
<tr>
	<th>Image_before</th>
	<td>{{$issue->image_before}}</td>
</tr>
<tr>
	<th>Image_after</th>
	<td>{{$issue->image_after}}</td>
</tr>
</table>
<a class="btn btn-sm btn-primary" href="{{route('assistance.issues')}}">Liste</a>
<a class="btn btn-sm btn-primary" href="{{route('assistance.issues.edit',$issue->id)}}"><i class="fas fa-edit"></i></button>
 <button  class="btn btn-sm btn-danger" wire:click="destroyIssue({{$issue->id}})"><i class="fas fa-trash"></i></button>  
</div>