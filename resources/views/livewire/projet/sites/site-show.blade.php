<div>
      <div class="table-responsive">
        <table style="table-layout:fixed; width:100%" class="table table-bordered table-striped">
<tr>
	<th style="width:200px!important">Tache</th>
	
	<th>Debut</th>
	<th>Fin</th>
	<th>Budget</th>
	<th>Engage</th>
	<th>Avancement</th>
</tr>
@foreach($site->taches as $item)
<tr>
	<td>{{$item->tache}}</td>
	<td>{{$item->date_debut}}</td>
	<td>{{$item->date_fin}}</td>
		<td>{{\App\Uts::nbf($item->budget)}}</td>
			<td>{{$item->engage}}</td>
	<td>{{$item->completed}}%</td>

</tr>
@endforeach
</table></div>
</div>