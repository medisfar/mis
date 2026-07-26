<x-slot name="titre">Resultats</x-slot>

              <x-slot name="stitre">@include('livewire.monitoring.menu')</x-slot>
<div><table  class="table table-bordered table-striped">
<tr>
	<th>Description</th>
<th></th></tr>
@foreach($resultats as $item)
<tr>
	<td>{{$item->description}}</td>
<td><button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Modifier', 
content: {
type: 'component',
 name: 'monitoring.resultats.resultat-show',
key: {{ rand(0,1000) }},
params: {id:{{$item->id}}}
 }
})"><i class="fas fa-eye"></i></button> 
</tr>
@endforeach
</table>
{{$resultats->links()}}
    
</div>