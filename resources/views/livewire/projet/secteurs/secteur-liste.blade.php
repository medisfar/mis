

              <x-slot name="stitre">@include('livewire.projet.menu')</x-slot>
<div>
<button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Ajouter', 
content: {
type: 'component',
 name: 'projet.secteurs.secteur-add',
key: {{ rand(0,1000) }},
params: {}
 }
})">Ajouter</button><br><br><input type="text" wire:model.live="search"/><div class="table-responsive">
<table  class="table table-bordered table-striped">
<tr>
	<th>Nom_secteur</th>
	<th>Mission</th>
<th></th></tr>
@foreach($secteurs as $item)
<tr>
	<td>{{$item->nom_secteur}}</td>
	<td>{{$item->Mission->libelle??''}}</td>
<td><button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Modifier', 
content: {
type: 'component',
 name: 'projet.secteurs.secteur-edit',
key: {{ rand(0,1000) }},
params: {id:{{$item->id}}}
 }
})"><i class="fas fa-eye"></i></button> <button  class="btn btn-sm btn-danger" wire:confirm="êtes-vous sûr de vouloir supprimer" wire:click="destroySecteur({{$item->id}})"><i class="fas fa-trash"></i></button>  
</td>
</tr>
@endforeach
</table></div>
{{$secteurs->links()}}
    
</div>