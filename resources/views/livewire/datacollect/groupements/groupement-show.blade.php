<x-slot name="titre">Groupements</x-slot>

              <x-slot name="stitre">@include('livewire.projet.menu')</x-slot>
<div>
<table  class="table table-bordered">
<tr>
	<th>Nom_groupe</th>
	<td>{{$groupement->nom_groupe}}</td>
</tr>
<tr>
	<th>Site</th>
	<td>{{$groupement->site->nom??''}}</td>

</tr>
<tr>
	<th>Statut</th>
	<td>{{$groupement->statut}}</td>
</tr>
</table> <div class="table-responsive">
 <table  class="table table-bordered table-striped">
 <tr>
 	<th>Menage</th>

 	<th>Genre</th>
 	<th>Nom</th>
 	<th>Date_naissance</th>
 	<th>Lien_parente</th>
 
 <th></th></tr>
 @foreach($groupement->membres as $item)
 <tr>
 	<td>{{$item->menage_id??''}}</td>
	
 	<td>{{$item->genre==1?'M':'F'}}</td>
 	<td>{{$item->nom}}</td>
 	<td>{{$item->date_naissance}}</td>
 	<td>{{$item->lelien_parente}}</td>
 
 	
 <td>
   </td>
 </tr>
 @endforeach
 </table></div>
</div>