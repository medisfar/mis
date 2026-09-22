<x-slot name="titre">Echeances</x-slot>

              <x-slot name="stitre">@include('livewire.microfinance.menu')</x-slot>
<div>
<button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Ajouter', 
content: {
type: 'component',
 name: 'microfinance.echeances.echeance-add',
key: {{ rand(0,1000) }},
params: {}
 }
})">Ajouter</button><br><br><input type="text" wire:model.live="search"/><div class="table-responsive">
<table  class="table table-bordered table-striped">
<tr>
	<th>Date_echeance</th>
	<th>Montant_paye</th>
<th></th></tr>
@foreach($echeances as $item)
<tr>
	<td>{{$item->date_echeance}}</td>
	<td>{{$item->montant_paye}}</td>
<td><button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Modifier', 
content: {
type: 'component',
 name: 'microfinance.echeances.echeance-edit',
key: {{ rand(0,1000) }},
params: {id:{{$item->id}}}
 }
})">Modifier</button> <button  class="btn btn-sm btn-danger" wire:confirm="êtes-vous sûr de vouloir supprimer" wire:click="destroyEcheance({{$item->id}})">Supprimer</button>  
</td>
</tr>
@endforeach
</table></div>
{{$echeances->links()}}
    
</div>