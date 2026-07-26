<x-slot name="titre">Localites</x-slot>

              <x-slot name="stitre">@include('livewire.geolocalisation.menu')</x-slot>
<div>

<a class="btn btn-sm btn-success" href="{{route('geolocalisation.localites.add')}}">Ajouter</a>
<br><br>

        <div class="table-responsive">
        <table  class="table table-bordered table-striped">
<tr>
	<th>Nom localite</th>
	<th>Ssprefecture</th>
	<th>type</th>
<th></th></tr>
@foreach($localites as $item)
<tr>
	<td>{{$item->nom_localite}}</td>
	<td>{{$item->ssprefecture->nom_ssprefecture??''}}</td>
	<td>{{$item->letype}}</td>
<td><a class="btn btn-sm btn-primary"  href="{{route('geolocalisation.localites.show',$item->id)}}">Voir</a>
</td>
</tr>
@endforeach
</table></div>
{{$localites->links()}}
    
</div>