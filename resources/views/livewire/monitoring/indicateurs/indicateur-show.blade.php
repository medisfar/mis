<x-slot name="titre">Indicateurs ,o</x-slot>

              <x-slot name="stitre">@include('livewire.monitoring.menu')</x-slot>
<div>
<table  class="table table-bordered table-sm">
<tr>
	<th width="50%">Activite</th>
	<th>Nom</th>

	
</tr>
<tr>
		<td>{{$indicateur->activite->activite??''}}</td>
	<td>{{$indicateur->nom}}</td>
	
</tr>
</table><table  class="table table-bordered">
<tr>
	<th>Frequence</th><th>Niveau</th><th>Source</th>
	
</tr>

<tr>
	<td>{{$indicateur->lafrequence}}</td>
	<td>{{$indicateur->leniveau}}</td><td>{{$indicateur->lasource}}</td>
</tr>

<tr>
	<th>Baseline</th><th>Cible finale</th>	<th>Valeur actuelle</th>
	
</tr>
<tr>
	<td>{{$indicateur->baseline}}</td>
	<td>{{$indicateur->cible_finale}}</td>	<td>{{$indicateur->valeur_actuelle}}</td>
</tr>

</table>

<table class="table table-sm">
    <tr>
        <th>Periode</th>
        <th>Valeur</th>
    </tr>
    @foreach($indicateur->valeurs as $v)
<tr>
    <td>{{$v->periode}}</td>
      <td>{{$v->valeur}}</td>
</tr>
@endforeach
</table>
</div>