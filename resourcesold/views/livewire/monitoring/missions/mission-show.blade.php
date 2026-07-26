<x-slot name="titre">Missions</x-slot>

              <x-slot name="stitre">@include('livewire.monitoring.menu')</x-slot>
<div>
<table  class="table table-bordered">
<tr>
	<th>Libelle</th>
	<td>{{$mission->libelle}}</td>
</tr>
<tr>
	<th>Description</th>
	<td>{{$mission->description}}</td>
</tr>
</table>
<a class="btn btn-sm btn-primary" href="{{route('monitoring.missions')}}">Liste</a>
<a class="btn btn-sm btn-primary" href="{{route('monitoring.missions.edit',$mission->id)}}">Modifier</a>
 <button  class="btn btn-sm btn-danger" wire:click="destroyMission({{$mission->id}})">Supprimer</button>  
</div>