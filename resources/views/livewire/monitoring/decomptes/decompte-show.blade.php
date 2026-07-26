<x-slot name="titre">Decomptes</x-slot>

              <x-slot name="stitre">@include('livewire.monitoring.menu')</x-slot>
<div>
<table  class="table table-bordered">
<tr>
	<th>Activite</th>
	<td>{{$decompte->activite->activite??''}}</td>
	<td>{{$decompte->activite_id}}</td>
</tr>
<tr>
	<th>Site</th>
	<td>{{$decompte->site->nom??''}}</td>
	<td>{{$decompte->site_id}}</td>
</tr>
<tr>
	<th>Montant</th>
	<td>{{$decompte->montant}}</td>
</tr>
<tr>
	<th>Date_effective</th>
	<td>{{$decompte->date_effective}}</td>
</tr>
</table>
<a class="btn btn-sm btn-primary" href="{{route('monitoring.decomptes')}}">Liste</a>
<a class="btn btn-sm btn-primary" href="{{route('monitoring.decomptes.edit',$decompte->id)}}"><i class="fas fa-edit"></i></button>
 <button  class="btn btn-sm btn-danger" wire:click="destroyDecompte({{$decompte->id}})"><i class="fas fa-trash"></i></button>  
</div>