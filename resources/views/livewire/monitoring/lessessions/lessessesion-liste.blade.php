<x-slot name="titre">Lessessesions</x-slot>

              <x-slot name="stitre">@include('livewire.monitoring.menu')</x-slot>
<div>
<button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Ajouter', 
content: {
type: 'component',
 name: 'monitoring.lessessions.lessessesion-add',
key: {{ rand(0,1000) }},
params: {}
 }
})">Ajouter</button><br><br><input type="text" wire:model.live="search"/><div class="table-responsive">
<table  class="table table-bordered table-striped">
<tr>
	<th>Site</th>
	<th>Nom</th>
	<th>Date_session</th>
	<th>Groupement</th>
<th></th></tr>
@foreach($lessessions as $item)
<tr>
	<td>{{$item->Site->nom??''}}</td>
	<td>{{$item->nom??''}}</td>
	<td>{{$item->date_session}}</td>
	<td>G{{$item->Groupement->nom_groupe??''}}</td>
<td><button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Modifier', 
content: {
type: 'component',
 name: 'monitoring.lessessions.lessessesion-edit',
key: {{ rand(0,1000) }},
params: {id:{{$item->id}}}
 }
})">Modifier</button> <button  class="btn btn-sm btn-danger" wire:confirm="êtes-vous sûr de vouloir supprimer" wire:click="destroyLessessesion({{$item->id}})">Supprimer</button>  
</td>
</tr>
@endforeach
</table></div>
{{$lessessions->links()}}
    
</div>