

              <x-slot name="stitre">@include('livewire.projet.menu')</x-slot>
<div>
<button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Ajouter', 
content: {
type: 'component',
 name: 'projet.resultats.resultat-add',
key: {{ rand(0,1000) }},
params: {}
 }
})">Ajouter</button><br><br><input type="text" wire:model.live="search"/><div class="table-responsive">
<table  class="table table-bordered table-striped">
<tr>
<th width="40%">Description</th>	<th>Mission</th>
	

<th></th></tr>
@foreach($resultats as $item)
<tr>
	
	<td>{{$item->description}}</td>
	<td>{{$item->mission->libelle??''}}</td>
	
<td><button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Modifier', 
content: {
type: 'component',
 name: 'projet.resultats.resultat-edit',
key: {{ rand(0,1000) }},
params: {id:{{$item->id}}}
 }
})"><i class="fas fa-edit"></i></button> <button  class="btn btn-sm btn-danger" wire:confirm="êtes-vous sûr de vouloir supprimer" wire:click="destroyResultat({{$item->id}})"><i class="fas fa-trash"></i></button>  

<button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Show', 
content: {
type: 'component',
 name: 'projet.resultats.resultat-show',
key: {{ rand(0,1000) }},
params: {id:{{$item->id}}}
 }
})"><i class="fas fa-eye"></i></button>
</td>
</tr>
@endforeach
</table></div>
{{$resultats->links()}}
    
</div>