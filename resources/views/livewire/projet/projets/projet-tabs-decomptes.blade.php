 <table  class="table table-bordered table-striped">
<tr>
	<th>Activite</th>
	<th>Date_previsionnelle</th>
	<th>Pourcentage</th>
	<th>Date_effective</th>
<th></th></tr>
@foreach($projet->composantes as $c)
@if($c!=null)
@foreach($c->activites as $a)
$if($a!=null)
@foreach($a->decomptes as $item)
<tr>
	<td>{{$item->Activite->activite??''}}</td>
	<td>{{$item->date_previsionnelle}}</td>
	<td>{{$item->pourcentage}}</td>
	<td>{{$item->date_effective}}</td>
<td><a class="btn btn-sm btn-primary"  href="{{route('projet.decomptes.show',$item->id)}}">Voir</a>
</td>
</tr>
@endforeach
@enif
@endforeach
@endif
@endforeach
</table>