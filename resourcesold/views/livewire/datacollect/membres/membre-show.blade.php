<x-slot name="titre">Membres</x-slot>

              <x-slot name="stitre">@include('livewire.datacollect.menu')</x-slot>
<div>
<table  class="table table-bordered">
<tr>
	<th>Menage</th>
	<td>{{$membre->menage->toit_id??''}}</td>
	<td>{{$membre->menage_id}}</td>
</tr>
<tr>
	<th>Genre</th>
	<td>{{$membre->genre}}</td>
</tr>
<tr>
	<th>Nom</th>
	<td>{{$membre->nom}}</td>
</tr>
<tr>
	<th>Date_naissance</th>
	<td>{{$membre->date_naissance}}</td>
</tr>
<tr>
	<th>Lien_parente</th>
	<td>{{$membre->lelien_parente}}</td>
</tr>
<tr>
	<th>Enceinte</th>
	<td>{{$membre->enceinte}}</td>
</tr>
</table>
<a class="btn btn-sm btn-primary" href="{{route('datacollect.membres')}}">Liste</a>
<a class="btn btn-sm btn-primary" href="{{route('datacollect.membres.edit',$membre->id)}}">Modifier</a>
 <button  class="btn btn-sm btn-danger" wire:click="destroyMembre({{$membre->id}})">Supprimer</button>  

</div>