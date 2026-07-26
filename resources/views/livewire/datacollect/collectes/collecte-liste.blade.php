<x-slot name="titre">Lessessionstest</x-slot>

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
})">Ajouter</button><br><br><div class="table-responsive">
    
     
<table  class="table table-bordered table-striped">
<tr>
	<th>Nom session</th>
	<th>Site</th>
	<th>Date_session</th>
	<th>Groupement</th>
	<th>Nbre</th>
<th></th></tr>
@foreach($collectes as $item)
<tr>
	<td>{{$item->nom}}</td>
	<td>{{$item->Site->nom??''}}</td>
	<td>{{$item->date_session}}</td>
	<td>{{$item->Groupement->nom_groupe??''}}</td>
	<td>{{count($item->donnees)}}/{{count($item->groupement->membres)}}</td>
	 
<td>
	<a class="btn btn-sm btn-success" href="{{route('select.membres',['sid'=>$item->id,'gid'=>$item->groupement_id])}}">Saisir</a>
	<button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Modifier', 
content: {
type: 'component',
 name: 'datacollect.lessessions.lessession-edit',
key: {{ rand(0,1000) }},
params: {id:{{$item->id}}}
 }
})"><i class="fas fa-eye"></i></button> <button  class="btn btn-sm btn-danger" wire:confirm="êtes-vous sûr de vouloir supprimer" wire:click="destroyLessession({{$item->id}})"><i class="fas fa-trash"></i></button>  

</td>
</tr>
@endforeach
</table>

</div>