
              <x-slot name="stitre">@include('livewire.projet.menu')</x-slot>
<div>
<button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Ajouter', 
content: {
type: 'component',
 name: 'projet.composantes.composante-add',
key: {{ rand(0,1000) }},
params: {}
 }
})">Ajouter</button><br><br>
<div class="table-responsive">
  <table class="table table-bordered table-striped" style="text-align:center;">
  <tr>
      <th rowspan="2">Code</th>
      <th rowspan="2" width="40%">Description</th>
      <th rowspan="2">Projet</th>
      <th rowspan="2">Budget</th>
       <th rowspan="2">Decaisse</th>
      <th colspan="2">Activites</th>
      <th colspan="2"></th>
    </tr>

    <tr>
      <th>En cours</th>
      <th>Termines</th>
      <th></th>
     
    </tr>
@foreach($composantes as $item)
<tr>
	<td>{{$item->code}}</td>
	<td>{{$item->description}}</td>
	<td>{{$item->Projet->libelle??''}}</td>
		<td>{{$item->budget??''}}</td>
			<td>{{$item->decaisse??''}}</td>
	  <td>
        {{ \App\Models\Activite::where('statut', 1)->where('composante_id', $item->id)->count() }}
      </td>
      <td>
        {{ \App\Models\Activite::where('statut', 2)->where('composante_id', $item->id)->count() }}
      </td>
      <td>
	<a class="btn btn-sm btn-primary"  href="{{route('gantt',$item->id)}}"><i class="fas fa-eye"></i></a>
	<button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Modifier', 
content: {
type: 'component',
 name: 'projet.composantes.composante-edit',
key: 'edit{{$item->id}}}' ,
params: {id:{{$item->id}}}
 }
})"><i class="fas fa-edit"></i></button>
 <button  class="btn btn-sm btn-danger" wire:confirm="êtes vous sûr?"  wire:click="destroyComposante({{$item->id}})"><i class="fas fa-trash"></i></button>
 
</td></tr>
@endforeach
</table></div>
{{$composantes->links()}}
    
</div>