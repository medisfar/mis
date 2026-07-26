<x-slot name="titre">Projets</x-slot>

              <x-slot name="stitre">@include('livewire.projet.menu')</x-slot>
<div>

<a class="btn btn-sm btn-success" href="{{route('projet.projets.add')}}">Ajouter</a>
<br><br>
<input type="text" wire:model="search"/>
        <div class="table-responsive">
        <table  class="table table-bordered table-striped">
<tr>
	<th>Code</th>
	<th>Nom projet</th>
	<th>Budget</th>
	<th>Date debut</th>
	<th>Date fin</th>
	<th>Statut</th>
<th></th></tr>
@foreach($projets as $item)
<tr>
	<td>{{$item->code}}</td>
	<td>{{$item->nom_projet}}</td>
	<td>{{$item->budget}}</td>
	<td>{{$item->date_debut}}</td>
	<td>{{$item->date_fin}}</td>
	<td>{{$item->statut}}</td>
<td><a class="btn btn-sm btn-primary"  href="{{route('projet.projets.show',$item->id)}}">Voir</a>
</td>
</tr>
@endforeach
</table></div>
{{$projets->links()}}
    
</div>