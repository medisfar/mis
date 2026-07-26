<x-slot name="titre">Localites</x-slot>

              <x-slot name="stitre">Show des localites</x-slot>
<div>
<table  class="table table-bordered">
<tr>
	<th>Nom localite</th>
	<td>{{$localite->nom_localite}}</td>
</tr>
<tr>
	<th>Ssprefecture</th>
	<td>{{$localite->ssprefecture->prefecture_id??''}}</td>
</tr>
<tr>
	<th>L type</th>
	<td>{{$localite->l_type}}</td>
</tr>
</table>
<a class="btn btn-sm btn-primary" href="{{route('projet.localites')}}">Liste</a>
<a class="btn btn-sm btn-primary" href="{{route('projet.localites.edit',$localite->id)}}">Modifier</a>
 <button  class="btn btn-sm btn-danger" wire:click="destroyLocalite">Supprimer</button>  
</div>