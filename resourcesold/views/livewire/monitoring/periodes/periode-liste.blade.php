<x-slot name="titre">Periodes</x-slot>

              <x-slot name="stitre">@include('livewire.monitoring.menu')</x-slot>
<div>
<button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Ajouter', 
content: {
type: 'component',
 name: 'monitoring.periodes.periode-add',
key: {{ rand(0,1000) }},
params: {}
 }
})">Ajouter</button><br><br><input type="text" wire:model.live="search"/><div class="table-responsive">
<table  class="table table-bordered table-striped">
<tr>
	<th width="25%">Activite</th>
	<th width="25%">Indicateur</th>
	<th>Date_debut</th>
	<th>Date_fin</th>
	<th>Cible</th>
<th></th></tr>
@foreach($periodes as $item)
<tr>
	
	<td>{{$item->Indicateur->activite->activite??''}}</td>
<td>{{$item->Indicateur->nom??''}}</td>
	<td>{{$item->date_debut}}</td>

	<td>{{$item->date_fin}}</td>
	<td>{{$item->cible}}</td>
<td><button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Modifier', 
content: {
type: 'component',
 name: 'monitoring.periodes.periode-edit',
key: {{ rand(0,1000) }},
params: {id:{{$item->id}}}
 }
})">Modifier</button> <button  class="btn btn-sm btn-danger" wire:confirm="êtes-vous sûr de vouloir supprimer" wire:click="destroyPeriode({{$item->id}})">Supprimer</button>  
</td>
</tr>
@endforeach
</table></div>
{{$periodes->links()}}
    
</div>