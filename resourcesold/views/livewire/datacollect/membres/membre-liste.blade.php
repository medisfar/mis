
              <x-slot name="stitre">@include('livewire.datacollect.menu')</x-slot>
<div>

<br><br>Rechercher menage id <input type="text" wire:model.live="search"/>
<br><br>
<div class="table-responsive">
<table  class="table table-bordered table-striped">
<tr>
	<th>Menage</th>
	<th>Genre</th>
	<th>Nom</th>
	<th>Date_naissance</th>
	<th>Lien_parente</th>
	<th>Enceinte</th>
<th></th></tr>
@foreach($membres as $item)
<tr>
	<td>{{$item->menage_id??''}}</td>
	<td>{{$item->genre==1?'M':'F'}}</td>
	<td>{{$item->nom}}</td>
	<td>{{$item->date_naissance}}</td>
	<td>{{$item->lelien_parente}}</td>
	<td>{{$item->enceinte==0?'Non':'Oui'}}</td>
	
<td>
    
    <button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Modifier', 
content: {
type: 'component',
 name: 'datacollect.membres.membre-edit',
key: {{ rand(0,1000) }},
params: {id:{{$item->id}}}
 }
})">Modifier</button>

<button  class="btn btn-sm btn-danger" wire:confirm="êtes-vous sûr de vouloir supprimer" wire:click="destroyMembre({{$item->id}})">Supprimer</button>  
</td>
</tr>
@endforeach
</table></div>
{{$membres->links()}}
    
</div>