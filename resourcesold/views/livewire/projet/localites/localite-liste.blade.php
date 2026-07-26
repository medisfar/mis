<x-slot name="titre">Localites</x-slot>

              <x-slot name="stitre">@include('livewire.projet.menu')</x-slot>
<div>

<a class="btn btn-sm btn-success" href="{{route('projet.localites.add')}}">Ajouter</a>
<br><br>

        <div class="table-responsive">
        <table  class="table table-bordered table-striped">
<tr>
	<th>Nom localite</th>
	<th>Ssprefecture</th>
	<th>L type</th>
<th></th></tr>
@foreach($localites as $item)
<tr>
	<td>{{$item->nom_localite}}</td>
	<td>{{$item->Ssprefecture->prefecture_id??''}}</td>
	<td>{{$item->l_type}}</td>
<td><a class="btn btn-sm btn-primary"  href="{{route('projet.localites.show',$item->id)}}">Voir</a>
</td>
</tr>
@endforeach
</table></div>
{{$localites->links()}}
    
</div>