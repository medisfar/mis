
              <x-slot name="stitre">@include('livewire.datacollect.menu')</x-slot>
<div>
<button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Ajouter', 
content: {
type: 'component',
 name: 'datacollect.menages.menage-add',
key: {{ rand(0,1000) }},
params: {}
 }
})">Ajouter</button><br><br>Rechercher menage id <input type="text" wire:model.live="search"/>
<br><br>	
<div class="table-responsive">
<table  class="table table-bordered table-striped">
<tr>
	<th>Menage</th>
	
	
	<th>Chef</th>
	<th>Conjoint</th>
	<th>Tel1</th>
	<th>Localite</th>
<th></th></tr>
@foreach($menages as $item)
<tr>
	<td>{{$item->id}}</td>
	
	<td>{{$item->chef}}</td>
	<td>{{$item->conjoint}}</td>
	<td>{{$item->tel1}}</td>
	<td>{{$item->Localite->nom_localite??''}}</td>
	
<td>
    <a class="btn btn-sm btn-success"
href="{{route('datacollect.menages.show',$item->id)}}">Show</a>
    <button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Modifier', 
content: {
type: 'component',
 name: 'datacollect.menages.menage-edit',
key: {{ rand(0,1000) }},
params: {}
 }
})">Modifier</button> <button  class="btn btn-sm btn-danger" wire:confirm="êtes-vous sûr de vouloir supprimer" wire:click="destroyMenage({{$item->id}})">Supprimer</button>  
</td>
</tr>
@endforeach
</table></div>
{{$menages->links()}}
    
</div>