<x-slot name="titre">Toits</x-slot>

              <x-slot name="stitre">@include('livewire.datacollect.menu')</x-slot>
<div>
<table  class="table table-bordered">
<tr>
	<th>Zone</th>
	<td>{{$toit->zone->nom_zone??''}}</td>
	<td>{{$toit->zone_id}}</td>
</tr>
<tr>
	<th>Adresse</th>
	<td>{{$toit->adresse}}</td>
</tr>
</table>
<a class="btn btn-sm btn-primary" href="{{route('datacollect.toits')}}">Liste</a>
<a class="btn btn-sm btn-primary" href="{{route('datacollect.toits.edit',$toit->id)}}">Modifier</a>
 <button  class="btn btn-sm btn-danger" wire:click="destroyToit({{$toit->id}})">Supprimer</button>  
</div>