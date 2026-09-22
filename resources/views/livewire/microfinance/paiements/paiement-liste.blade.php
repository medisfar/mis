<x-slot name="titre">Paiements</x-slot>

              <x-slot name="stitre">@include('livewire.microfinance.menu')</x-slot>
<div>
<button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Ajouter', 
content: {
type: 'component',
 name: 'microfinance.paiements.paiement-add',
key: {{ rand(0,1000) }},
params: {}
 }
})">Ajouter</button><br><br><input type="text" wire:model.live="search"/><div class="table-responsive">
<table  class="table table-bordered table-striped">
<tr>
	<th>Credit</th>
	<th>Date_paiement</th>
	<th>Montant_paye</th>
	<th>Montant_restant</th>
<th></th></tr>
@foreach($paiements as $item)
<tr>
	<td>{{$item->credit_id}}</td>
	<td>{{$item->date_paiement}}</td>
	<td>{{$item->montant_paye}}</td>
	<td>{{$item->montant_restant}}</td>
<td><button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Modifier', 
content: {
type: 'component',
 name: 'microfinance.paiements.paiement-edit',
key: {{ rand(0,1000) }},
params: {id:{{$item->id}}}
 }
})">Modifier</button> <button  class="btn btn-sm btn-danger" wire:confirm="êtes-vous sûr de vouloir supprimer" wire:click="destroyPaiement({{$item->id}})">Supprimer</button>  
</td>
</tr>
@endforeach
</table></div>
{{$paiements->links()}}
    
</div>