<div>

<a class="btn btn-sm btn-success" href="{{route('projet.activites.add')}}">Ajouter</a>
<br><br>
<input type="text" wire:model="search"/>
        <div class="table-responsive">
        <table  class="table table-bordered table-striped">
<tr>
	<th>Activite</th>
	<th>Sous composante</th>
	<th>Date debut</th>
	<th>Date fin</th>
	<th>Completed</th>
<th></th></tr>
@foreach($activites as $item)
<tr>
	<td>{{$item->activite}}</td>
	<td>{{$item->souscomposante->code??''}}</td>
	<td>{{$item->date_debut}}</td>
	<td>{{$item->date_fin}}</td>
	<td>{{$item->completed}}%</td>
	
<td><a class="btn btn-sm btn-primary"  href="{{route('projet.activites.show',$item->id)}}">Voir</a>
</td>
</tr>
@endforeach
</table></div>

    
</div>