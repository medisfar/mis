

              <x-slot name="stitre">@include('livewire.projet.menu')</x-slot>
<div>
<button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Ajouter', 
content: {
type: 'component',
 name: 'projet.bailleurs.bailleur-add',
key: {{ rand(0,1000) }},
params: {}
 }
})">Ajouter</button><br><br><div class="table-responsive">
<table class="table table-bordered table-striped program-table">
<tr>
	<th>Code</th>
	<th>Nom_bailleur</th>
<th></th></tr>
@foreach($bailleurs as $item)
<tr>
	<td>{{$item->code}}</td>
	<td>{{$item->nom_bailleur}}</td>
<td><button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Modifier', 
content: {
type: 'component',
 name: 'projet.bailleurs.bailleur-edit',
key: {{ rand(0,1000) }},
params: {id:{{$item->id}}}
 }
})"><i class="fas fa-eye"></i></button>
 <button  class="btn btn-sm btn-danger" wire:confirm="êtes vous sûr?"  wire:click="destroyBailleur({{$item->id}})"><i class="fas fa-trash"></i></button> 
 </td>
</tr>
@endforeach
</table></div>
{{$bailleurs->links()}}
    
</div>
