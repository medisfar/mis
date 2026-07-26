<x-slot name="titre">Activites</x-slot>

              <x-slot name="stitre">@include('livewire.projet.menu')</x-slot>
<div>

<a class="btn btn-sm btn-success" href="{{route('projet.activites.add')}}">Ajouter</a>
<br><br>
<input type="text" wire:model.live="search"/>
        <div class="table-responsive">
        <table  class="table table-bordered table-striped">
<tr>
	<th>Nom_activite</th>
	<th>Composante</th>
	<th>Sous_composante</th>
	<th>Date_debut</th>
	<th>Date_fin</th>
	<th>Completed</th>
<th></th></tr>
@foreach($activites as $item)
<tr>
	<td>{{$item->nom_activite}}</td>
	<td>{{$item->composante->code??''}}</td>
	<td>{{$item->Souscomposante->code??''}}</td>
	<td>{{$item->date_debut}}</td>
	<td>{{$item->date_fin}}</td>
	<td>{{$item->completed}}</td>
<td><a class="btn btn-sm btn-primary"  href="{{route('projet.activites.show',$item->id)}}">Voir</a>
</td>
</tr>
@endforeach
</table></div>
{{$activites->links()}}
    
</div>