 <div class="table-responsive">
        <table  class="table table-bordered table-striped">
<tr>
	<th>Code</th>
	<th>Libelle</th>
	<th>Nom_projet</th>
	<!--<th>Objectifs</th>-->
	<th>Budget</th>
	<th>Date_debut</th>
	<th>Date_fin</th>
	<th>Statut</th>

<th></th></tr>
@foreach($projets as $item)
<tr>
	<td>{{$item->code}}</td>
	<td>{{$item->libelle}}</td>
	<td>{{$item->nom_projet}}</td>
	<!--<td>{{$item->objectifs}}</td>-->
	<td>{{$item->budget}}</td>
	<td>{{$item->date_debut}}</td>
	<td>{{$item->date_fin}}</td>
	<td>{{$item->lestatut}}</td>
	
<td><a class="btn btn-sm btn-primary"  href="{{route('projet.projets.show',$item->id)}}">Voir</a>
</td>
</tr>
@endforeach
</table></div>
{{$projets->links()}}
    