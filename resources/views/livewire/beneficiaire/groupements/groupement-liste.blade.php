<div>
<button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Ajouter', 
content: {
type: 'component',
 name: 'beneficiaire.groupements.groupement-add',
key: {{ rand(0,1000) }},
params: {}
 }
})">Ajouter</button><br><br><input type="text" wire:model.live="search"/><div class="table-responsive">
<table  class="table table-bordered table-striped">
<tr>
	<th>Nom_groupe</th>
	<th>Site</th>
	<th>Membres</th>
<th></th></tr>
@foreach($groupements as $item)
<tr>
	<td>{{$item->nom_groupe}}</td>
	<td>{{$item->Site->nom??''}}</td>
	<td>{{$item->membres->count()}}</td>
<td><button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Modifier', 
content: {
type: 'component',
 name: 'beneficiaire.groupements.groupement-edit',
key: {{ rand(0,1000) }},
params: {id:{{$item->id}}}
 }
})"><i class="fas fa-edit"></i>
</button>
<button  class="btn btn-sm btn-danger" wire:confirm="êtes-vous sûr de vouloir supprimer" wire:click="destroyGroupement({{$item->id}})"><i class="fas fa-trash"></i></button>  
<a class="btn btn-sm btn-primary"  href="{{route('beneficiaire.groupements.show',$item->id)}}">Voir</a>
<a class="btn btn-sm btn-primary"  href="{{route('foyers.xls',$item->id)}}">xlxs</a>
</tr>
@endforeach
</table></div>
{{$groupements->links()}}
    
</div>