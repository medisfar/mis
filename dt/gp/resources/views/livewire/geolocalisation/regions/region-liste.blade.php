<x-slot name="titre">Regions</x-slot>

              <x-slot name="stitre">@include('livewire.geolocalisation.menu')</x-slot>
<div>

<a class="btn btn-sm btn-success" href="{{route('geolocalisation.regions.add')}}">Ajouter</a>
<br><br>

        <div class="table-responsive">
        <table  class="table table-bordered table-striped">
<tr>
	<th>Code</th>
	<th>Nom_region</th>
<th></th></tr>
@foreach($regions as $item)
<tr>
	<td>{{$item->code}}</td>
	<td>{{$item->nom_region}}</td>
<td><a class="btn btn-sm btn-primary"  href="{{route('geolocalisation.regions.show',$item->id)}}">Voir</a>
</td>
</tr>
@endforeach
</table></div>
{{$regions->links()}}
    
</div>