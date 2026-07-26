<x-slot name="titre">Credits</x-slot>

              <x-slot name="stitre">@include('livewire.datacollect.menu')</x-slot>
<div>
<button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Ajouter', 
content: {
type: 'component',
 name: 'pret.credits.credit-add',
key: {{ rand(0,1000) }},
params: {}
 }
})">Ajouter</button><br><br><input type="text" wire:model.live="search"/><div class="table-responsive">
<table  class="table table-bordered table-striped">
<tr>
	<th>Membre</th>
	<th>Date_credit</th>
	<th>Montant</th>
	<th>Nbre_echeance</th>
<th></th></tr>
@foreach($credits as $item)
<tr>
	<td>{{$item->membre->nom??''}}</td>
	<td>{{$item->date_credit}}</td>
	<td>{{$item->montant}}</td>
	<td>{{$item->nbre_echeance}}</td>
<td><button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Modifier', 
content: {
type: 'component',
 name: 'pret.credits.credit-edit',
key: {{ rand(0,1000) }},
params: {id:{{$item->id}}}
 }
})"><i class="fas fa-eye"></i></button> <button  class="btn btn-sm btn-danger" wire:confirm="êtes-vous sûr de vouloir supprimer" wire:click="destroyCredit({{$item->id}})"><i class="fas fa-trash"></i></button>  
</td>
</tr>
@endforeach
</table></div>
{{$credits->links()}}
    
</div>