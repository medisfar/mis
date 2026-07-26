<x-slot name="titre">Lessessions</x-slot>

              <x-slot name="stitre">@include('livewire.datacollect.menu')</x-slot>
<div>
<button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Ajouter', 
content: {
type: 'component',
 name: 'datacollect.lessessions.lessession-add',
key: {{ rand(0,1000) }},
params: {}
 }
})">Ajouter</button><br><br><input type="text" wire:model.live="search"/><div class="table-responsive">
<table  class="table table-bordered table-striped">
<tr>
	<th>Nom</th>
	<th>Site</th>
	<th>Date_session</th>
	<th>Groupement</th>
<th></th></tr>
@foreach($lessessions as $item)
<tr>
	<td>{{$item->nom}}</td>
	<td>{{$item->Site->nom??''}}</td>
	<td>{{$item->date_session}}</td>
	<td>{{$item->Groupement->projet_id??''}}</td>
<td>
	<a class="btn btn-sm btn-success" href="{{route('select.membres',['sid'=>$item->id,'gid'=>$item->groupement_id])}}">Donnees</a>
	<button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Modifier', 
content: {
type: 'component',
 name: 'datacollect.lessessions.lessession-edit',
key: {{ rand(0,1000) }},
params: {id:{{$item->id}}}
 }
})">Modifier</button> <button  class="btn btn-sm btn-danger" wire:confirm="êtes-vous sûr de vouloir supprimer" wire:click="destroyLessession({{$item->id}})">Supprimer</button>  
<a href="{{route('datacollect.lessessions.show',$item->id)}}">show</a>
</td>
</tr>
@endforeach
</table></div>
{{$lessessions->links()}}
    
</div>