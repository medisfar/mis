<x-slot name="titre">Regions</x-slot>

              <x-slot name="stitre">@include('livewire.geolocalisation.menu')</x-slot>
<div>
<table  class="table table-bordered">
<tr>
	<th>Code</th>
	<td>{{$region->code}}</td>
</tr>
<tr>
	<th>Nom_region</th>
	<td>{{$region->nom_region}}</td>
</tr>
</table>
<a class="btn btn-sm btn-primary" href="{{route('geolocalisation.regions')}}">Liste</a>
<a class="btn btn-sm btn-primary" href="{{route('geolocalisation.regions.edit',$region->id)}}"><i class="fas fa-edit"></i></button>
 <button  class="btn btn-sm btn-danger" wire:click="destroyRegion({{$region->id}})"><i class="fas fa-trash"></i></button>  
</div>