<h4>Resultats
<a class="btn btn-sm btn-primary"  href="{{route('projet.resultats.add',['idm'=>$projet->id])}}">Ajouter</a></h4>
<table  class="table table-bordered table-striped">
<tr>

	<th>Description</th>
<th></th></tr>
@foreach($projet->resultats as $item)
<tr>
	
	<td>resultat: {{$item->description}}</td>
<td><a class="btn btn-sm btn-primary"  href="{{route('projet.resultats.show',$item->id)}}">Voir</a>
<a class="btn btn-sm btn-primary"  href="{{route('projet.produits.add',['idm'=>$item->id])}}">Ajouter Produit</a>
</td>
</tr>

@foreach($item->produits as $sitem)
<tr>
	<td>produit: {{$sitem->description}}</td>
<td><a class="btn btn-sm btn-primary"  href="{{route('projet.produits.show',$sitem->id)}}">Voir</a>
</td>
</tr>
@endforeach

@endforeach
</table>