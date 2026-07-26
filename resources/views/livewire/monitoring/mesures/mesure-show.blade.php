<x-slot name="titre">Mesures</x-slot>

              <x-slot name="stitre">@include('livewire.monitoring.menu')</x-slot>
<div>
<table  class="table table-bordered">
<tr>
	<th>Indicateur</th>
	<td>{{$mesure->indicateur->activite_id??''}}</td>
	<td>{{$mesure->indicateur_id}}</td>
</tr>
<tr>
	<th>Periode</th>
	<td>{{$mesure->periode->activite_id??''}}</td>
	<td>{{$mesure->periode_id}}</td>
</tr>
<tr>
	<th>Cible</th>
	<td>{{$mesure->cible}}</td>
</tr>
<tr>
	<th>Valeur</th>
	<td>{{$mesure->valeur}}</td>
</tr>
<tr>
	<th>Statut</th>
	<td>{{$mesure->statut}}</td>
</tr>
<tr>
	<th>Commentaire</th>
	<td>{{$mesure->commentaire}}</td>
</tr>
</table>
<a class="btn btn-sm btn-primary" href="{{route('monitoring.mesures')}}">Liste</a>
<a class="btn btn-sm btn-primary" href="{{route('monitoring.mesures.edit',$mesure->id)}}"><i class="fas fa-edit"></i></button>
 <button  class="btn btn-sm btn-danger" wire:click="destroyMesure({{$mesure->id}})"><i class="fas fa-trash"></i></button>  
</div>