<x-slot name="titre">outils</x-slot>

              <x-slot name="stitre">@include('livewire.projet.menu')</x-slot>
<div>
<button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Ajouter', 
content: {
type: 'component',
 name: 'datacollect.formulaires.formulaire-add',
key: {{ rand(0,1000) }},
params: {}
 }
})">Ajouter</button><br><br><input type="text" wire:model.live="search"/><div class="table-responsive">
<table  class="table table-bordered table-striped">
<tr>
	<th>Nom</th>
	<th>Projet</th>
	<th>Fields</th>
	<th>Actif</th>
<th></th></tr>
@foreach($formulaires as $item)
<tr>
	<td>{{$item->nom}}</td>
	<td>{{$item->Projet->code??''}}</td>
	<td>{{$item->fields}}</td>
	<td>{{$item->actif}}</td>
<td>
<button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Modifier', 
content: {
type: 'component',
 name: 'form-builder',
key: {{ rand(0,1000) }},
params: {fid:{{$item->id}}}
 }
})">Definitions</button>	



<button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Modifier', 
content: {
type: 'component',
 name: 'datacollect.formulaires.formulaire-edit',
key: {{ rand(0,1000) }},
params: {id:{{$item->id}}}
 }
})"><i class="fas fa-eye"></i></button> <button  class="btn btn-sm btn-danger" wire:confirm="êtes-vous sûr de vouloir supprimer" wire:click="destroyFormulaire({{$item->id}})"><i class="fas fa-trash"></i></button>  
</td>
</tr>
@endforeach
</table></div>
{{$formulaires->links()}}
    
</div>