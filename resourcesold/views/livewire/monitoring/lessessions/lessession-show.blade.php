<x-slot name="titre">Lessessions</x-slot>

              <x-slot name="stitre">@include('livewire.monitoring.menu')</x-slot>
<div>
<table  class="table table-bordered">
<tr>
	<th>Site</th>
	<td>{{$lessession->site->nom??''}}</td>
	<td>{{$lessession->site_id}}</td>
</tr>
<tr>
	<th>Date_session</th>
	<td>{{$lessession->date_session}}</td>
</tr>
<tr>
	<th>Groupement</th>
	<td>{{$lessession->groupement->projet_id??''}}</td>
	<td>{{$lessession->groupement_id}}</td>
</tr>
</table>
<a class="btn btn-sm btn-primary" href="{{route('monitoring.lessessions')}}">Liste</a>
<a class="btn btn-sm btn-primary" href="{{route('monitoring.lessessions.edit',$lessession->id)}}">Modifier</a>
 <button  class="btn btn-sm btn-danger" wire:click="destroyLessession({{$lessession->id}})">Supprimer</button>  
</div>