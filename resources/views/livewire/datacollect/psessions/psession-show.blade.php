<x-slot name="titre">Psessions</x-slot>

              <x-slot name="stitre">@include('livewire.datacollect.menu')</x-slot>
<div>
<table  class="table table-bordered">
<tr>
	<th>Nom</th>
	<td>{{$psession->nom}}</td>
</tr>
<tr>
	<th>Projet</th>
	<td>{{$psession->projet->code??''}}</td>
	<td>{{$psession->projet_id}}</td>
</tr>
<tr>
	<th>Actif</th>
	<td>{{$psession->actif}}</td>
</tr>
</table>
<a class="btn btn-sm btn-primary" href="{{route('datacollect.psessions')}}">Liste</a>
<a class="btn btn-sm btn-primary" href="{{route('datacollect.psessions.edit',$psession->id)}}"><i class="fas fa-edit"></i></button>
 <button  class="btn btn-sm btn-danger" wire:click="destroyPsession({{$psession->id}})"><i class="fas fa-trash"></i></button>  
</div>