<x-slot name="titre">Lessessesions</x-slot>

              <x-slot name="stitre">@include('livewire.monitoring.menu')</x-slot>
<div>
<table  class="table table-bordered">
<tr>
	<th>Site</th>
	<td>{{$lessessesion->site->nom??''}}</td>
	<td>{{$lessessesion->site_id}}</td>
</tr>
<tr>
	<th>Date_session</th>
	<td>{{$lessessesion->date_session}}</td>
</tr>
<tr>
	<th>Groupement</th>
	<td>{{$lessessesion->groupement->projet_id??''}}</td>
	<td>{{$lessessesion->groupement_id}}</td>
</tr>
</table>
<a class="btn btn-sm btn-primary" href="{{route('monitoring.lessessions')}}">Liste</a>
<a class="btn btn-sm btn-primary" href="{{route('monitoring.lessessions.edit',$lessessesion->id)}}">Modifier</a>
 <button  class="btn btn-sm btn-danger" wire:click="destroyLessessesion({{$lessessesion->id}})">Supprimer</button>  
</div>