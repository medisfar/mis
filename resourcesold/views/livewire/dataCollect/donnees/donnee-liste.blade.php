<x-slot name="titre">Donnees</x-slot>

              <x-slot name="stitre">@include('livewire.dataCollect.menu')</x-slot>
<div>
<button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Ajouter', 
content: {
type: 'component',
 name: 'dataCollect.donnees.donnee-add',
key: {{ rand(0,1000) }},
params: {}
 }
})">Ajouter</button><br><br><input type="text" wire:model.live="search"/><div class="table-responsive">
<table  class="table table-bordered table-striped">
<tr>
	<th>Site</th>
	<th>Groupement</th>
	<th>Session</th>
	<th>Membre</th>
	<th>Metadonnees</th>
<th></th></tr>
@foreach($donnees as $item)
<tr>
	<td>{{$item->Site->nom??''}}</td>
	<td>{{$item->Groupement->projet_id??''}}</td>
	<td>{{$item->Session->user_id??''}}</td>
	<td>{{$item->Membre->menage_id??''}}</td>
	<td>{{$item->metadonnees}}</td>
<td><button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Modifier', 
content: {
type: 'component',
 name: 'dataCollect.donnees.donnee-edit',
key: {{ rand(0,1000) }},
params: {id:{{$item->id}}}
 }
})">Modifier</button> <button  class="btn btn-sm btn-danger" wire:confirm="êtes-vous sûr de vouloir supprimer" wire:click="destroyDonnee({{$item->id}})">Supprimer</button>  
</td>
</tr>
@endforeach
</table></div>
{{$donnees->links()}}
    
</div>