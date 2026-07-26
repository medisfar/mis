<x-slot name="titre">Resultats</x-slot>

              <x-slot name="stitre">@include('livewire.monitoring.menu')</x-slot>
<div>
<table  class="table table-bordered">
<tr>
	<th>Description </th>
	<td>{{$resultat->description}}</td>
</tr>
</table>
 <table>
     <tr><th>Produits contribiteurs</th></tr>
 @foreach(\DB::select('select * from produit_resultat pp, produits p where pp.produit_id=p.id and resultat_id=?',[$resultat->id]) as $p)
<tr>
	
	<td>{{$p->description}}+</td>
</tr>


@endforeach
</table>

</div>