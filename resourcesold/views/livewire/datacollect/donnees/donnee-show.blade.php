<x-slot name="titre">Donnees</x-slot>

              <x-slot name="stitre">@include('livewire.datacollect.menu')</x-slot>
<div>
	<h4>{{$donnee->membre->nom??''}}</hr>
	<h6>{{$donnee->created_at}}</h6>
<table  class="table table-bordered">
@foreach(json_decode($donnee->donnes,1)??[] as $k=>$v)
<tr>
	<th>{{$k}}</th>
	<td>{{$v}}</td>
</tr>
@endforeach
</table>
<a class="btn btn-sm btn-primary" href="{{route('datacollect.donnees')}}">Liste</a>
<a class="btn btn-sm btn-primary" href="{{route('datacollect.donnees.edit',$donnee->id)}}">Modifier</a>
 <button  class="btn btn-sm btn-danger" wire:click="destroyDonnee({{$donnee->id}})">Supprimer</button>  
</div>