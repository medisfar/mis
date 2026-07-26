<x-slot name="titre">Lessessions</x-slot>

              <x-slot name="stitre">@include('livewire.monitoring.menu')</x-slot>
<div>
<button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Ajouter', 
content: {
type: 'component',
 name: 'monitoring.lessessions.lessession-add',
key: {{ rand(0,1000) }},
params: {}
 }
})">Ajouter</button><br><br>
<input type="text" wire:model.live="search"/>



</div>
<div class="table-responsive">
<table  class="table table-bordered table-striped">
<tr>
	<th>Site</th>
	<th>Nom</th>
	<th>Date_session</th>
	<th>Groupement</th>
<th></th>
@foreach($lessessions as $item)
<tr>
	<td>{{$item->Site->nom??''}}</td>
	<td>{{$item->nom??''}}</td>
	<td>{{$item->date_session}}</td>
	<td>{{$item->Groupement->nom_groupe??''}}</td>
<td>
<a class="btn btn-sm btn-success" href="{{route('select.membres',['sid'=>$item->id,'gid'=>$item->groupement_id])}}">Donnees</a>

<button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Ajout ', 
content: {
type: 'component',
 name: 'monitoring.lessessions.lessession-edit',
key: {{ rand(0,1000) }},
params: {id:{{$item->id}}}
 }
})"><i class="fas fa-eye"></i></button>

 <button  class="btn btn-sm btn-danger" wire:confirm="êtes-vous sûr de vouloir supprimer" wire:click="destroyLessession({{$item->id}})"><i class="fas fa-trash"></i></button>  
</td>
</tr>
@endforeach
</table></div>
{{$lessessions->links()}}
    
</div>