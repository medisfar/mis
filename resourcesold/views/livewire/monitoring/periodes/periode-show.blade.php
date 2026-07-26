<x-slot name="titre">Periodes</x-slot>

              <x-slot name="stitre">@include('livewire.monitoring.menu')</x-slot>
<div>
<table  class="table table-bordered">
<tr>
	<th>Activite</th>
	<td>{{$periode->indicateur->activite??''}}</td>
	<td>{{$periode->activite_id}}</td>
</tr>
<tr>
	<th>Indicateur</th>
	<td>{{$periode->indicateur->activite_id??''}}</td>
	<td>{{$periode->indicateur_id}}</td>
</tr>
<tr>
	<th>Date_debut</th>
	<td>{{$periode->date_debut}}</td>
</tr>
<tr>
	<th>Date_fin</th>
	<td>{{$periode->date_fin}}</td>
</tr>
<tr>
	<th>Cible</th>
	<td>{{$periode->cible}}</td>
</tr>
</table>
<a class="btn btn-sm btn-primary" href="{{route('monitoring.periodes')}}">Liste</a>
<a class="btn btn-sm btn-primary" href="{{route('monitoring.periodes.edit',$periode->id)}}">Modifier</a>
 <button  class="btn btn-sm btn-danger" wire:click="destroyPeriode({{$periode->id}})">Supprimer</button>  
</div>