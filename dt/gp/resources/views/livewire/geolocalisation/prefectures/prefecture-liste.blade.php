<x-slot name="titre">Prefectures</x-slot>

              <x-slot name="stitre">@include('livewire.geolocalisation.menu')</x-slot>
<div>

<a class="btn btn-sm btn-success" href="{{route('geolocalisation.prefectures.add')}}">Ajouter</a>
<br><br>

        <div class="table-responsive">
        <table  class="table table-bordered table-striped">
<tr>
	<th>Region</th>
	<th>Code</th>
	<th>Nom_prefecture</th>
	<th>Type</th>
<th></th></tr>
@foreach($prefectures as $item)
<tr>
	<td>{{$item->Region->nom_region??''}}</td>
	<td>{{$item->code}}</td>
	<td>{{$item->nom_prefecture}}</td>
	<td>{{$item->letype}}</td>
<td><a class="btn btn-sm btn-primary"  href="{{route('geolocalisation.prefectures.show',$item->id)}}">Voir</a>
</td>
</tr>
@endforeach
</table></div>
{{$prefectures->links()}}
    
</div>