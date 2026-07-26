<x-slot name="titre">Ssprefectures</x-slot>

              <x-slot name="stitre">@include('livewire.geolocalisation.menu')</x-slot>
<div>

<a class="btn btn-sm btn-success" href="{{route('geolocalisation.ssprefectures.add')}}">Ajouter</a>
<br><br>

        <div class="table-responsive">
        <table  class="table table-bordered table-striped">
<tr>
	<th>Prefecture</th>
	<th>Code</th>
	<th>Nom_ssprefecture</th>
	<th>Type</th>
<th></th></tr>
@foreach($ssprefectures as $item)
<tr>
	<td>{{$item->Prefecture->region_id??''}}</td>
	<td>{{$item->code}}</td>
	<td>{{$item->nom_ssprefecture}}</td>
	<td>{{$item->letype}}</td>
<td><a class="btn btn-sm btn-primary"  href="{{route('geolocalisation.ssprefectures.show',$item->id)}}">Voir</a>
</td>
</tr>
@endforeach
</table></div>
{{$ssprefectures->links()}}
    
</div>