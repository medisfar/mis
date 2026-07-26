<x-slot name="titre">Menages</x-slot>

              <x-slot name="stitre">@include('livewire.datacollect.menu')</x-slot>
<div> 
<table  class="table table-bordered">
<tr>
	<th>Localite</th>
	<td>{{$menage->localite->nom_localite??''}}</td>

</tr>
<tr>
	<th>Toit</th>
	<td>{{$menage->toit->zone_id??''}}</td>
	
</tr>
<tr>
	<th>Menage</th>
	<td>Chef {{$menage->chef}} /  Conjoint {{$menage->conjoint}}</td>
</tr>

<tr>
	<th>Tel</th>
	<td>{{$menage->tel1}} / {{$menage->tel2}}</td>
</tr>

</table>
<button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Ajouter', 
content: {
type: 'component',
 name: 'datacollect.membres.membre-add',
key: {{ rand(0,1000) }},
params: {idm:{{$menage->id}}}
 }
})">Ajouter</button>
<a class="btn btn-sm btn-primary" href="{{route('datacollect.menages')}}">Liste</a>
<a class="btn btn-sm btn-primary" href="{{route('datacollect.menages.edit',$menage->id)}}">Modifier</a>
 <button  class="btn btn-sm btn-danger" wire:click="destroyMenage({{$menage->id}})">Supprimer</button>  
 
 
 <div class="table-responsive">
<table  class="table table-bordered table-striped">
<tr>
	
	<th>Genre</th>
	<th>Nom</th>
	<th>Date_naissance</th>
	<th>Lien_parente</th>
	<th>Enceinte</th>
<th></th></tr>
@foreach($menage->membres as $item)
<tr>
	
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
</div>