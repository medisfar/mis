<x-slot name="titre">Donnees</x-slot>

              <x-slot name="stitre">@include('livewire.datacollect.menu')</x-slot>
<div>
<button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Ajouter', 
content: {
type: 'component',
 name: 'datacollect.donnees.donnee-add',
key: {{ rand(0,1000) }},
params: {}
 }
})">Ajouter</button><br><br><input type="text" wire:model.live="search"/><div class="table-responsive">

<table  class="table table-bordered table-striped">
<tr>
	<th>Collecte</th>
	<th>Session</th>
	<th>Membre</th>
	<th>Date_session</th>
	<th>Donnees</th>
<th></th></tr>

@foreach($lesdonnees as $item)
<tr>
	<td>{{$item->Collecte->projet_id??''}}</td>
	<td>{{$item->Session->user_id??''}}</td>
	<td>{{$item->Membre->menage_id??''}}</td>
	<td>{{$item->date_session}}</td>
	<td>{{$item->donnees}}</td>
<td><button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Modifier', 
content: {
type: 'component',
 name: 'datacollect.donnees.donnee-edit',
key: {{ rand(0,1000) }},
params: {id:{{$item->id}}}
 }
})">Modifier</button> <button  class="btn btn-sm btn-danger" wire:confirm="êtes-vous sûr de vouloir supprimer" wire:click="destroyDonnee({{$item->id}})">Supprimer</button>  
</td>
</tr>
@endforeach

</table></div>
{{$lesdonnees->links()}}
    
</div>