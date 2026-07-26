<x-slot name="titre">Indicateurs</x-slot>

              <x-slot name="stitre">@include('livewire.monitoring.menu')</x-slot>
<div>
<button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Ajouter', 
content: {
type: 'component',
 name: 'monitoring.indicateurs.indicateur-add',
key: {{ rand(0,1000) }},
params: {}
 }
})">Ajouter</button><br><br><input type="text" wire:model.live="search"/><div class="table-responsive">
<table  class="table table-bordered table-striped">
<tr>
	<th width="30%">Activite</th>
	<th>Nom</th>
	
	<th>Frequence</th>
	
<th></th></tr>
@foreach($indicateurs as $item)
<tr>
	<td>{{$item->Activite->activite??''}}</td>
	<td>{{$item->nom}}</td>

	<td>{{$item->lafrequence}}</td>
<td><button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Modifier', 
content: {
type: 'component',
 name: 'monitoring.indicateurs.indicateur-edit',
key: {{ rand(0,1000) }},
params: {id:{{$item->id}}}
 }
})">Modifier</button> <button  class="btn btn-sm btn-danger" wire:confirm="êtes-vous sûr de vouloir supprimer" wire:click="destroyIndicateur({{$item->id}})">Supprimer</button>  
<a class="btn btn-sm btn-success" href="{{route('monitoring.indicateurs.show',$item->id)}}">Show</a>
</td>
</tr>
@endforeach
</table></div>
{{$indicateurs->links()}}
    
</div>