<x-slot name="titre">Indicateurs</x-slot>

              <x-slot name="stitre">@include('livewire.projet.menu')</x-slot>
<div>
<button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Ajouter', 
content: {
type: 'component',
 name: 'projet.indicateurs.indicateur-add',
key: {{ rand(0,1000) }},
params: {}
 }
})">Ajouter</button><br><br><input type="text" wire:model.live="search"/><div class="table-responsive">
<table  class="table table-bordered table-striped">
<tr>
	<th>Activite</th>
	<th>Nom</th>
	<th>Frequence</th>
	<th>Baseline</th>

	<th>Valeur_actuelle</th>
	<th>Niveau</th>
	<th>Source</th>
<th></th></tr>
@foreach($indicateurs as $item)
<tr>
	<td>{{$item->Activite->activite??''}}</td>
	<td>{{$item->nom}}</td>
	<td>{{$item->lafrequence}}</td>
	<td>{{$item->baseline}}</td>
	<td>{{$item->valeur_actuelle}}</td>
	<td>{{$item->leniveau}}</td>
	<td>{{$item->lasource}}</td>
<td><button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Modifier', 
content: {
type: 'component',
 name: 'projet.indicateurs.indicateur-edit',
key: {{ rand(0,1000) }},
params: {id:{{$item->id}}}
 }
})"><i class="fa fa-edit"></i></button>
<button  class="btn btn-sm btn-danger" wire:confirm="êtes-vous sûr de vouloir supprimer" wire:click="destroyIndicateur({{$item->id}})"><i class="fa fa-trash"></i></button>  
<button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Show', 
content: {
type: 'component',
 name: 'projet.indicateurs.indicateur-show',
key: {{ rand(0,1000) }},
params: {id:{{$item->id}}}
 }
})"><i class="fa fa-eye"></i></button>
</td>
</tr>
@endforeach
</table></div>
{{$indicateurs->links()}}
    
</div>