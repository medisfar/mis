<div>
	@php

	$site=\App\Models\Site::find($idm);

@endphp

	<table>
		<tr>
			<td colspan="3"><h3>Site {{$site->nom}}</h3></td>
		</tr>
		@if($site->decomptes)
		@foreach($site->decomptes as $dc)
		<tr>
			<td>{{$dc->montant}}</td>
			<td>{{$dc->date_effectif??''}}</td>
			<td><button wire:click="handleViewUpdate('site',{{$dc->id}},{{$idp}})">voir</button></td>
		</tr>
		@endforeach
		@endif
	</table>
	
</div>