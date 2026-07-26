<x-slot name="titre">Sessions</x-slot>

              <x-slot name="stitre">@include('livewire.datacollect.menu')</x-slot>
<div>
 <a class="btn btn-sm btn-success" href="{{route('datacollect.psessions.add')}}">Ajouter</a><br><br><input type="text" wire:model.live="search"/><div class="table-responsive">
<table  class="table table-bordered table-striped">
<tr>
	<th>Nom</th>
	<th>Projet</th>
	<th>Actif</th>
<th></th></tr>
@foreach($psessions as $item)
<tr>
	<td>{{$item->nom}}</td>
	<td>{{$item->Projet->code??''}}</td>
	<td>{{$item->actif}}</td>
<td>
    <a class="btn btn-sm btn-success" href="{{route('form.builder',['fid'=>$item->id])}}">voir</a>
    <button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Modifier', 
content: {
type: 'component',
 name: 'datacollect.psessions.psession-edit',
key: {{ rand(0,1000) }},
params: {id:{{$item->id}}}
 }
})">Modifier</button> <button  class="btn btn-sm btn-danger" wire:confirm="êtes-vous sûr de vouloir supprimer" wire:click="destroyPsession({{$item->id}})">Supprimer</button>  
</td>
</tr>
@endforeach
</table></div>
{{$psessions->links()}}
    
</div>