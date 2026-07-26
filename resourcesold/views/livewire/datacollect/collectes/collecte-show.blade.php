<x-slot name="titre">Collectes</x-slot>

              <x-slot name="stitre">@include('livewire.datacollect.menu')</x-slot>
<div>
<table  class="table table-bordered">
<tr>
	<th>Projet</th>
	<td>{{$collecte->projet->code??''}}</td>
	<td>{{$collecte->projet_id}}</td>
</tr>
<tr>
	<th>Site</th>
	<td>{{$collecte->site->nom??''}}</td>
	<td>{{$collecte->site_id}}</td>
</tr>
</table>
<a class="btn btn-sm btn-primary" href="{{route('datacollect.collectes')}}">Liste</a>
<a class="btn btn-sm btn-primary" href="{{route('datacollect.collectes.edit',$collecte->id)}}">Modifier</a>
 <button  class="btn btn-sm btn-danger" wire:click="destroyCollecte({{$collecte->id}})">Supprimer</button>  
</div>