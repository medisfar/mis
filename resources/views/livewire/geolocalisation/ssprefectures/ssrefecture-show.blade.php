<x-slot name="titre">Ssrefectures</x-slot>

              <x-slot name="stitre">@include('livewire.geolocalisation.menu')</x-slot>
<div>
<table  class="table table-bordered">
<tr>
	<th>Prefecture</th>
	<td>{{$ssrefecture->prefecture->region_id??''}}</td>
</tr>
<tr>
	<th>Code</th>
	<td>{{$ssrefecture->code}}</td>
</tr>
<tr>
	<th>Nom ssprefecture</th>
	<td>{{$ssrefecture->nom_ssprefecture}}</td>
</tr>
<tr>
	<th>type</th>
	<td>{{$ssprefecture->letype}}</td>
</tr>
</table>
<a class="btn btn-sm btn-primary" href="{{route('geolocalisation.ssprefectures')}}">Liste</a>
<a class="btn btn-sm btn-primary" href="{{route('geolocalisation.ssprefectures.edit',$ssrefecture->id)}}"><i class="fas fa-edit"></i></button>
 <button  class="btn btn-sm btn-danger" wire:click="destroySsrefecture({{$ssrefecture->id}})"><i class="fas fa-trash"></i></button>  
</div>