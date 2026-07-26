
            
<div>
<button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Ajouter', 
content: {
type: 'component',
 name: 'monitoring.decomptes.decompte-add',
key: {{ rand(0,1000) }},
params: {}
 }
})">Ajouter</button><br><br><input type="text" wire:model.live="search"/><div class="table-responsive">
<table  class="table table-bordered table-striped">
<tr>
	<th>Activite</th>
	<th>Site</th>
	<th>Montant</th>
	<th>Date_effective</th>
<th></th></tr>
@foreach($decomptes as $item)
<tr>
	<td>{{$item->Activite->activite??''}}</td>
	<td>{{$item->Site->nom??''}}</td>
	<td>{{$item->montant}}</td>
	<td>{{$item->date_effective}}</td>
<td><button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Modifier', 
content: {
type: 'component',
 name: 'monitoring.decomptes.decompte-edit',
key: {{ rand(0,1000) }},
params: {id:{{$item->id}}}
 }
})"><i class="fas fa-eye"></i></button> <button  class="btn btn-sm btn-danger" wire:confirm="êtes-vous sûr de vouloir supprimer" wire:click="destroyDecompte({{$item->id}})"><i class="fas fa-trash"></i></button>  
</td>
</tr>
@endforeach
</table></div>
{{$decomptes->links()}}
    
</div>