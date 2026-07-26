
              <x-slot name="stitre">@include('livewire.projet.menu')</x-slot>
<div>
<button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Ajouter', 
content: {
type: 'component',
 name: 'projet.composantes.composante-add',
key: {{ rand(0,1000) }},
params: {}
 }
})">Ajouter</button><br><br>

<div class="table-responsive">
<table  class="table table-bordered table-striped">
<tr>
	<th>Code</th>
	<th width="40%">Description</th>
	<th>Projet</th>
		<th>Budget</th>
<th></th></tr>
@foreach($composantes as $item)
<tr>
	<td>{{$item->code}}</td>
	<td>{{$item->description}}</td>
	<td>{{$item->Projet->code??''}}</td>
		<td>{{$item->budget??''}}</td>
<td>
	<a class="btn btn-sm btn-primary"  href="{{route('gantt',$item->id)}}">Voir</a>
	<button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Modifier', 
content: {
type: 'component',
 name: 'projet.composantes.composante-edit',
key: {{ rand(0,1000) }},
params: {id:{{$item->id}}}
 }
})">Modifier</button>
 <button  class="btn btn-sm btn-danger" wire:confirm="êtes vous sûr?"  wire:click="destroyComposante({{$item->id}})">Supprimer</button>
 
</td></tr>
@endforeach
</table></div>
{{$composantes->links()}}
    
</div>