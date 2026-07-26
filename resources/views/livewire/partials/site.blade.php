<div>
	@php

	$site=\App\Models\Site::find($idm);

@endphp

<h3>Site {{$site->nom}}</h3>
	<table>
		<tr>
			<th>Tache</th>
			<th>Buget</th>
			<th>Engage</th>
		</tr>
		@if($site->taches)
		@foreach($site->taches as $dc)
		<tr>
			<td>{{$dc->tache}}</td>
			<td>{{$dc->budget??''}}</td>
			<td>{{$dc->engage??''}}</td>
			<td> </td>
		@endforeach
		@endif
	</table>
	
</div>