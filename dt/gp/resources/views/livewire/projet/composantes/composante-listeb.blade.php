<div>
<h4>Composantes
<a class="btn btn-sm btn-success pull-right" href="{{route('projet.composantes.add',$pid)}}">Ajouter</a>
</h4>

        <div class="table-responsive">
        <table  class="table table-bordered table-striped">
<tr>
	<th>Composante</th>
	
<th></th></tr>
@foreach($composantes as $item)
<tr>
	<td>{{$item->composante}}</td>
	
<td><a class="btn btn-sm btn-primary"  href="{{route('projet.composantes.show',$item->id)}}">Voir</a>
</td>
</tr>
@endforeach
</table></div>

    
</div>