<br><br><h4>Composante
<a class="btn btn-sm btn-primary"  href="{{route('projet.composantes.add',['idm'=>$projet->id])}}">Ajouter</a></h4>
<table  class="table table-bordered table-striped">
<tr>
	<th>code</th>
	<th>Description</th>
	
<th></th></tr>
@foreach($projet->composantes as $item)
<tr style="background:teal; color:white">


	<td>{{$item->code}}</td>
<td></td>
	<td>{{$item->description}}</td>
	
<td width="100">
    <a class="btn btn-sm btn-primary"  href="{{route('projet.souscomposantes.add',['idm'=>$item->id])}}">+</a>
    <a class="btn btn-sm btn-primary"  href="{{route('projet.composantes.show',$item->id)}}">Voir</a>
</td>
</tr>
@foreach($item->souscomposantes as $sitem)
<tr>
	<td></td>	
	<td>{{$sitem->code}}</td>
	<td>{{$sitem->description}}</td>
	
<td><a class="btn btn-sm btn-primary"  href="{{route('projet.souscomposantes.show',$sitem->id)}}">Voir</a>
</td>
</tr>
@endforeach
@endforeach
</table>