<x-slot name="titre">Indicateurs</x-slot>

              <x-slot name="stitre">@include('livewire.monitoring.menu')</x-slot>
<div>
<table  class="table table-bordered">
<tr>
	<th width="50%">Activite</th>
	<th>Nom</th>

	
</tr>
<tr>
		<td>{{$indicateur->activite->activite??''}}</td>
	<td>{{$indicateur->nom}}</td>
	
</tr>
<tr>
	<th>Description</th>	<th>Formule</th>

</tr>
<tr>
	<td>{{$indicateur->description}}</td>
	<td>{{$indicateur->formule}}</td>
</tr
</table><table  class="table table-bordered">
<tr>
	<th>Frequence</th><th>Unite_mesure</th><th>Type_cible</th>
	
</tr>

<tr>
	<td>{{$indicateur->lafrequence}}</td>
	<td>{{$indicateur->unite_mesure}}</td><td>{{$indicateur->type_cible}}</td>
</tr>

<tr>
	<th>Baseline</th><th>Baseline_date</th>	<th>Est_actif</th>
	
</tr>
<tr>
	<td>{{$indicateur->baseline}}</td>
	<td>{{$indicateur->baseline_date}}</td>	<td>{{$indicateur->est_actif}}</td>
</tr>

</table>
<a class="btn btn-sm btn-primary" href="{{route('monitoring.indicateurs')}}">Liste</a>
<a class="btn btn-sm btn-primary" href="{{route('monitoring.indicateurs.edit',$indicateur->id)}}">Modifier</a>
 <button  class="btn btn-sm btn-danger" wire:click="destroyIndicateur({{$indicateur->id}})">Supprimer</button> 
 <button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Ajouter', 
content: {
type: 'component',
 name: 'monitoring.periodes.periode-add',
key: {{ rand(0,1000) }},
params: {}
 }
})">Ajouter</button> 
</div>