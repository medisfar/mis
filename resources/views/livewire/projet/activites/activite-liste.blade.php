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
</div><div class="table-responsive">
        <table  class="table table-bordered table-striped" style="table-layout: fixed; width: 100%;">
<tr>
<th width="200">Activite</th>
	
	
	<th width="130">Dates</th>

	<th width="100">Budget</th>
	<th width="100">Engage</th>
	<th width="100">Decaisse</th>
	
	<th width="120">Avancement</th>
	<th width="100">Statut</th>
                <th></th>
            </tr>
        </thead>
@foreach($activites as $item)
<tr>
	
	<td>{{$item->activite}}</td>
	
	
	<td>du {{$item->date_debut??''}}<br>au {{$item->date_fin??''}}</td>
		

	<td class="nbre">{{\App\Uts::nbf($item->budget)??''}}</td>
	<td class="nbre">{{\App\Uts::nbf($item->engage)??''}}</td>
	<td class="nbre">{{\App\Uts::nbf($item->decaisse)??''}}</td>
	
	<td>{{$item->completed}}%</td>
	<td>{{$item->lestatut}}</td>
<td><a class="btn btn-sm btn-primary"  href="{{route('projet.activites.show',$item->id)}}">Voir</a>

	<button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Modification', 
content: {
type: 'component',
 name: 'projet.activites.activite-edit',
key: {{ rand(0,1000) }},
params: {id:{{$item->id}}}
 }
})"><i class="fas fa-edit"</i></i></button>
 <button  class="btn btn-sm btn-danger"  wire:confirm="êtes vous sûr?" wire:click="destroyActivite({{$item->id}})"><i class="fas fa-trash"></i></button> 
</td>
</td>
</tr>
@endforeach
</table></div>
{{$activites->links()}}
    
</div>