<div>
     
<table  class="table table-bordered table-striped">
<tr>
	<th>Nom</th>
	<th>Budget</th>
	<th>Decaisse</th>
	<th>%</th>
<th></th></tr>
@foreach(\App\Models\Activite::find($aid)->sites as $item)
<tr>
	<td>{{$item->nom}}</td>
	<td>{{$item->budget??''}}</td>
	<td>{{$item->decaisse}}</td>
	<td>{{$item->completed??''}}</td>

</tr>
</table>	

    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
</div>
