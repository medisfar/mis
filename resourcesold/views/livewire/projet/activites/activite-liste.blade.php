<div>
<button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Ajouter', 
content: {
type: 'component',
 name: 'projet.activites.activite-add',
key: {{ rand(0,1000) }},
params: {}
 }
})">Ajouter</button>
<br><br>
<div class="row">


<x-select nc="3" label="Composante" fd="cid" :options="\App\Models\Composante::where('projet_id',session()->get('pid'))->pluck('code','id')"></x-select>
</div>
        <div class="table-responsive">
        <table  class="table table-bordered table-striped">
<tr>

	<th>Activite</th>
	
	<th>Sous <br>composante</th>
	<th>Budget</th>
	<th>Decaissé </th>
	<td>Completed</td>
<th></th></tr>
@foreach($activites as $item)
<tr>
	
	<td width="30%">{{$item->activite}}</td>

	<td>{{$item->Souscomposante->code??''}}</td>
	<td>{{$item->budget??''}}</td>
	<td>{{$item->decaisse}}</td>
	<td>{{$item->completed}}%</td>
<td><a class="btn btn-sm btn-primary"  href="{{route('projet.activites.show',$item->id)}}">Voir</a>
 <button  class="btn btn-sm btn-danger"  wire:confirm="êtes vous sûr?" wire:click="destroyActivite({{$item->id}})">Supprimer</button> 
</td>
</tr>
@endforeach
</table></div>
{{$activites->links()}}
    
</div>