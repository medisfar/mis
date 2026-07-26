<x-slot name="titre">Sessions</x-slot>

              <x-slot name="stitre">@include('livewire.datacollect.menu')</x-slot>
<div>
<table  class="table table-bordered">
<tr>
	<th>User</th>
	<td>{{$session->user->name??''}}</td>
	<td>{{$session->user_id}}</td>
</tr>
<tr>
	<th>Ip_address</th>
	<td>{{$session->ip_address}}</td>
</tr>
<tr>
	<th>User_agent</th>
	<td>{{$session->user_agent}}</td>
</tr>
<tr>
	<th>Payload</th>
	<td>{{$session->payload}}</td>
</tr>
<tr>
	<th>Last_activity</th>
	<td>{{$session->last_activity}}</td>
</tr>
</table>
<a class="btn btn-sm btn-primary" href="{{route('datacollect.sessions')}}">Liste</a>
<a class="btn btn-sm btn-primary" href="{{route('datacollect.sessions.edit',$session->id)}}">Modifier</a>
 <button  class="btn btn-sm btn-danger" wire:click="destroySession({{$session->id}})">Supprimer</button>  
</div>