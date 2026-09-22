<x-slot name="titre">Credits</x-slot>

              <x-slot name="stitre">@include('livewire.microfinance.menu')</x-slot>
<div>
<button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Ajouter', 
content: {
type: 'component',
 name: 'microfinance.credits.credit-add',
key: {{ rand(0,1000) }},
params: {}
 }
})">Ajouter</button><br><br><input type="text" wire:model.live="search"/><div class="table-responsive">
<table  class="table table-bordered table-striped">
<tr>
	<th>Membre</th>
	<th>Date_octroi</th>
	<th>Date_premiere_echeance</th>
	<th>Montant_echeance</th>
	<th>Nbre_echeance</th>
	<th>Termine</th>
<th></th></tr>
@foreach($credits as $item)
<tr>
	<td>{{$item->membre?->nom ?? 'Non attribué'}}</td>
	<td>{{$item->date_octroi}}</td>
	<td>{{$item->date_premiere_echeance}}</td>
	<td>{{$item->montant_echeance}}</td>
	<td>{{$item->nbre_echeance}}</td>
	<td>{{$item->termine}}</td>
<td><a class="btn btn-sm btn-primary" href="{{ route('microfinance.credits.show', $item->id) }}">Voir</a> <button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Modifier', 
content: {
type: 'component',
 name: 'microfinance.credits.credit-edit',
key: {{ rand(0,1000) }},
params: {id:{{$item->id}}}
 }
})">Modifier</button> <button  class="btn btn-sm btn-danger" wire:confirm="êtes-vous sûr de vouloir supprimer" wire:click="destroyCredit({{$item->id}})">Supprimer</button>  
</td>
</tr>
@endforeach
</table></div>
{{$credits->links()}}
    
</div>
