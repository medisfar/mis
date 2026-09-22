<x-slot name="titre">Epargnes</x-slot>

              <x-slot name="stitre">@include('livewire.microfinance.menu')</x-slot>
<div>
<button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Ajouter', 
content: {
type: 'component',
 name: 'microfinance.epargnes.epargne-add',
key: {{ rand(0,1000) }},
params: {}
 }
})">Ajouter</button><br><br><input type="text" wire:model.live="search"/><div class="table-responsive">
<table  class="table table-bordered table-striped">
<tr>
	<th>Membre</th>
	<th>Date_operation</th>
	<th>Type</th>
	<th>Montant</th>
<th></th></tr>
@foreach($epargnes as $item)
<tr>
	<td>{{$item->Membre->menage_id??''}}</td>
	<td>{{$item->date_operation}}</td>
	<td>{{$item->type}}</td>
	<td>{{$item->montant}}</td>
<td><button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Modifier', 
content: {
type: 'component',
 name: 'microfinance.epargnes.epargne-edit',
key: {{ rand(0,1000) }},
params: {id:{{$item->id}}}
 }
})">Modifier</button> <button  class="btn btn-sm btn-danger" wire:confirm="êtes-vous sûr de vouloir supprimer" wire:click="destroyEpargne({{$item->id}})">Supprimer</button>  
</td>
</tr>
@endforeach
</table></div>
{{$epargnes->links()}}
    
</div>