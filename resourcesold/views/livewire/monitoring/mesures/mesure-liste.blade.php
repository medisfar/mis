<x-slot name="titre">Mesures</x-slot>

              <x-slot name="stitre">@include('livewire.monitoring.menu')</x-slot>
<div>
<button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Ajouter', 
content: {
type: 'component',
 name: 'monitoring.mesures.mesure-add',
key: {{ rand(0,1000) }},
params: {}
 }
})">Ajouter</button><br><br><input type="text" wire:model.live="search"/><div class="table-responsive">
<table  class="table table-bordered table-striped">
<tr>
	<th>Indicateur</th>
	<th>Periode</th>
	<th>Cible</th>
	<th>Valeur</th>
	<th>Statut</th>
	<th>Commentaire</th>
<th></th></tr>
@foreach($mesures as $item)
<tr>
	<td>{{$item->Indicateur->activite_id??''}}</td>
	<td>{{$item->Periode->activite_id??''}}</td>
	<td>{{$item->cible}}</td>
	<td>{{$item->valeur}}</td>
	<td>{{$item->statut}}</td>
	<td>{{$item->commentaire}}</td>
<td><button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Modifier', 
content: {
type: 'component',
 name: 'monitoring.mesures.mesure-edit',
key: {{ rand(0,1000) }},
params: {id:{{$item->id}}}
 }
})">Modifier</button> <button  class="btn btn-sm btn-danger" wire:confirm="êtes-vous sûr de vouloir supprimer" wire:click="destroyMesure({{$item->id}})">Supprimer</button>  
</td>
</tr>
@endforeach
</table></div>
{{$mesures->links()}}
    
</div>