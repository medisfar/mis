<x-slot name="titre">Lessessions</x-slot>

              <x-slot name="stitre">@include('livewire.datacollect.menu')</x-slot>
<div>
<table  class="table table-bordered">
<tr>
	<th>Nom</th>
	<td>{{$lessession->nom}}</td>
</tr>
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

</tr>
<tr>
	<th>Type session</th>
	<td>{{$lessession->typesession->nom??''}}</td>
	
</tr>
</table>
<a class="btn btn-sm btn-primary" href="{{route('datacollect.lessessions')}}">Liste</a>
<a class="btn btn-sm btn-primary" href="{{route('datacollect.lessessions.edit',$lessession->id)}}"><i class="fas fa-edit"></i></button>
 <button  class="btn btn-sm btn-danger" wire:click="destroyLessession({{$lessession->id}})"><i class="fas fa-trash"></i></button>  
</div>