<x-slot name="titre">Echeances</x-slot>

              <x-slot name="stitre">@include('livewire.pret.menu')</x-slot>
<div>
<button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Ajouter', 
content: {
type: 'component',
 name: 'pret.echeances.echeance-add',
key: {{ rand(0,1000) }},
params: {}
 }
})">Ajouter</button><br><br><input type="text" wire:model.live="search"/><div class="table-responsive">
<table  class="table table-bordered table-striped">
<tr>
	<th>Membre</th>
	<th>Montant</th>
	<th>Date_paiement</th>
<th></th></tr>
@foreach($echeances as $item)
<tr>
	<td>{{$item->Membre->menage_id??''}}</td>
	<td>{{$item->montant}}</td>
	<td>{{$item->date_paiement}}</td>
<td><button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Modifier', 
content: {
type: 'component',
 name: 'pret.echeances.echeance-edit',
key: {{ rand(0,1000) }},
params: {id:{{$item->id}}}
 }
})"><i class="fas fa-eye"></i></button> <button  class="btn btn-sm btn-danger" wire:confirm="êtes-vous sûr de vouloir supprimer" wire:click="destroyEcheance({{$item->id}})"><i class="fas fa-trash"></i></button>  
</td>
</tr>
@endforeach
</table></div>
{{$echeances->links()}}
    
</div>