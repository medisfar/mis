

              <x-slot name="stitre">@include('livewire.datacollect.menu')</x-slot>
<div>
<button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Ajouter', 
content: {
type: 'component',
 name: 'datacollect.fields.field-add',
key: {{ rand(0,1000) }},
params: {}
 }
})">Ajouter</button><br><br><input type="text" wire:model.live="search"/><div class="table-responsive">
<table  class="table table-bordered table-striped">
<tr>
	<th>Nom</th>
	<th>Psession</th>
	<th>Row</th>
	<th>Col</th>
	<th>Options</th>
<th></th></tr>
@foreach($fields as $item)
<tr>
	<td>{{$item->nom}}</td>
	<td>{{$item->Psession->nom??''}}</td>
	<td>{{$item->row}}</td>
	<td>{{$item->col}}</td>
	<td>{{$item->options}}</td>
<td><button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Modifier', 
content: {
type: 'component',
 name: 'datacollect.fields.field-edit',
key: {{ rand(0,1000) }},
params: {id:{{$item->id}}}
 }
})">Modifier</button> <button  class="btn btn-sm btn-danger" wire:confirm="êtes-vous sûr de vouloir supprimer" wire:click="destroyField({{$item->id}})">Supprimer</button>  
</td>
</tr>
@endforeach
</table></div>
{{$fields->links()}}
    
</div>