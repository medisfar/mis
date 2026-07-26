<x-slot name="titre">Produits</x-slot>

              <x-slot name="stitre">@include('livewire.monitoring.menu')</x-slot>
<div>
<button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Ajouter', 
content: {
type: 'component',
 name: 'monitoring.produits.produit-add',
key: {{ rand(0,1000) }},
params: {}
 }
})">Ajouter</button><br><br><input type="text" wire:model.live="search"/><div class="table-responsive">
<table  class="table table-bordered table-striped">
<tr >
	<th>Description</th>
<th></th></tr>
@foreach($produits as $item)
<tr style="background:purple;color:white;">
	<td>{{$item->description}}</td>
	<td></td>
<td><button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Modifier', 
content: {
type: 'component',
 name: 'monitoring.produits.produit-edit',
key: {{ rand(0,1000) }},
params: {id:{{$item->id}}}
 }
})">Modifier</button> <button  class="btn btn-sm btn-danger" wire:confirm="êtes-vous sûr de vouloir supprimer" wire:click="destroyProduit({{$item->id}})">Supprimer</button>  
</td>
</tr>
@foreach($item->activites as $aitem)
<tr>
	<td>Activite: {{$aitem->activite}}</td>
	<td>{{$aitem->budget}}+</td>
</tr>


@endforeach

@endforeach
</table></div>

{{$produits->links()}}
    
</div>