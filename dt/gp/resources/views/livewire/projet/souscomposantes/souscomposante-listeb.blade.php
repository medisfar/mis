<div>
<h4>Sous composantes
<a class="btn btn-sm btn-success" href="{{route('projet.souscomposantes.add',$idr)}}">Ajouter</a></h4>
<br><br>
        <div class="table-responsive">
        <table  class="table table-bordered table-striped">
<tr>
	<th>Sous composante</th>
	<th>Composante</th>
<th></th></tr>
@foreach($souscomposantes as $item)
<tr>
	<td>{{$item->sous_composante}}</td>
	
<td><a class="btn btn-sm btn-primary"  href="{{route('projet.souscomposantes.show',$item->id)}}">Voir</a>
</td>
</tr>
@endforeach
</table></div>

    
</div>