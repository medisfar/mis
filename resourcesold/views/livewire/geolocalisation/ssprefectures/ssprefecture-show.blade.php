<x-slot name="titre">Ssprefectures</x-slot>

              <x-slot name="stitre">@include('livewire.geolocalisation.menu')</x-slot>
<div>
<table  class="table table-bordered">
<tr>
	<th>Prefecture</th>
	<td>{{$ssprefecture->prefecture->region_id??''}}</td>
	<td>{{$ssprefecture->prefecture_id}}</td>
</tr>
<tr>
	<th>Code</th>
	<td>{{$ssprefecture->code}}</td>
</tr>
<tr>
	<th>Nom_ssprefecture</th>
	<td>{{$ssprefecture->nom_ssprefecture}}</td>
</tr>
<tr>
	<th>Type</th>
	<td>{{$ssprefecture->letype}}</td>
</tr>
</table>
<a class="btn btn-sm btn-primary" href="{{route('geolocalisation.ssprefectures')}}">Liste</a>
<a class="btn btn-sm btn-primary" href="{{route('geolocalisation.ssprefectures.edit',$ssprefecture->id)}}">Modifier</a>
 <button  class="btn btn-sm btn-danger" wire:click="destroySsprefecture({{$ssprefecture->id}})">Supprimer</button>  
</div>