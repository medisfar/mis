

              <x-slot name="stitre">@include('livewire.projet.menu')</x-slot>
<div>

<button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Ajouter', 
content: {
type: 'component',
 name: 'Projet.projets.projet-add',
key: {{ rand(0,1000) }},
params: {}
 }
})">Ajouter</button><br><br><input type="text" wire:model.live="search"/><div class="table-responsive">
<table  class="table table-bordered table-striped">
<tr>
	<th>Code</th>
	<th>Libelle</th>
	
	
	<th>Budget</th>
	<th>Date_debut</th>
	<th>Date_fin</th>
	<th>Statut</th>
	
<th></th></tr>
@foreach($projets as $item)
<tr>
	<td>{{$item->code}}</td>
	<td>{{$item->libelle}}</td>
	
	<td>{{$item->budget}}</td>
	<td>{{$item->date_debut}}</td>
	<td>{{$item->date_fin}}</td>
	<td>{{$item->lestatut}}</td>
	
<td>
<a  class="btn btn-sm btn-success" href="{{route('projet.projets.show',$item->id)}}">Show</a>
	<button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Modifier', 
content: {
type: 'component',
 name: 'Projet.projets.projet-edit',
key: {{ rand(0,1000) }},
params: {id:{{$item->id}}}
 }
})">Modifier</button>
<button  class=" btn btn-sm btn-danger" wire:confirm="êtes vous sûr?" wire:click="destroyProjet({{$item->id}})">Supprimer</button>


</td>

</tr>
@endforeach
</table></div>
{{$projets->links()}}
    
</div>