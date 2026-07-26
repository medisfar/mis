<x-slot name="titre">Prefectures</x-slot>

              <x-slot name="stitre">@include('livewire.geolocalisation.menu')</x-slot>
<div>
<table  class="table table-bordered">
<tr>
	<th>Region</th>
	<td>{{$prefecture->region->nom_region??''}}</td>
	
</tr>
<tr>
	<th>Code</th>
	<td>{{$prefecture->code}}</td>
</tr>
<tr>
	<th>Nom_prefecture</th>
	<td>{{$prefecture->nom_prefecture}}</td>
</tr>
<tr>
	<th>Type</th>
	<td>{{$prefecture->letype}}</td>
</tr>
</table>
<a class="btn btn-sm btn-primary" href="{{route('geolocalisation.prefectures')}}">Liste</a>
<a class="btn btn-sm btn-primary" href="{{route('geolocalisation.prefectures.edit',$prefecture->id)}}">Modifier</a>
 <button  class="btn btn-sm btn-danger" wire:click="destroyPrefecture({{$prefecture->id}})">Supprimer</button>  
</div>