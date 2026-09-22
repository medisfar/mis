

              <x-slot name="stitre">@include('livewire.projet.menu')</x-slot>
<div>
<button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Ajouter', 
content: {
type: 'component',
 name: 'projet.souscomposantes.souscomposante-add',
key:'add-component',
params: {}
 }
})">Ajouter</button><br><br>
<div class="row">
`
<x-select nc="3" label="Composante" fd="cid" :options="\App\Models\Composante::where('projet_id',session()->get('pid'))->pluck('code','id')"></x-select>
</div>
<div class="table-responsive">
<table class="table table-bordered table-striped program-table">
<tr>
	<th>Code</th>
	<th width="40%">Description</th>
	<th>Composante</th>
<th></th></tr>
@foreach($souscomposantes as $item)
<tr>
	<td>{{$item->code}}</td>
	<td>{{$item->description}}</td>
	<td>{{$item->Composante->code??''}}</td>
<td><button wire:key="bt{{$item->id}}"class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Modifier', 
content: {
type: 'component',
 name: 'projet.souscomposantes.souscomposante-edit',
key: {{ rand(0,1000) }},
params: {id:{{$item->id}}}
 }
})"><i class="fas fa-edit"></i></button>
 <button  class="btn btn-sm btn-danger" wire:confirm="êtes vous sûr?" wire:click="destroySouscomposante({{$item->id}})"><i class="fas fa-trash"></i></button> 
</td>
</tr>
@endforeach
</table></div>
{{$souscomposantes->links()}}
    
</div>
