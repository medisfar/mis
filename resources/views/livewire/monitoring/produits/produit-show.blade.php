<x-slot name="titre">Produits</x-slot>

              <x-slot name="stitre">@include('livewire.monitoring.menu')</x-slot>
<div>
<table  class="table table-bordered">
<tr>
	<th>Description</th>
	<td>{{$produit->description}}</td>
</tr>
</table>
 <table class="table">
     <tr><th>Activite</th><th>Budget</th></tr>
 @foreach(\DB::select('select * from activite_produit a, activites p where a.activite_id=p.id and produit_id=?',[$produit->id]) as $p)
<tr>
	<td>{{$p->activite}}</td>
	<td>{{$p->budget}}</td>
</tr>


@endforeach
</table>
</div>