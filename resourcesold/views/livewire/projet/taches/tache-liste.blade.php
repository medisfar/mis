<div>

<button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Ajouter', 
content: {
type: 'component',
 name: 'projet.taches.tache-add',
key: {{ rand(0,1000) }},
params: {}
 }
})">Ajouter</button>
<div class="row">

<x-select nc="3" label="Composante" fd="cpid" :options="\App\Models\Composante::where('projet_id',session()->get('pid'))->pluck('description','id')"></x-select>
<x-select nc="3" label="Activite" fd="activite_id" :options="\App\Models\Activite::where('composante_id',$cpid)->pluck('activite','id')"></x-select>
<x-select nc="3" label="Site" fd="site_id" :options="\App\Models\Site::tab()"></x-select>
 </div>       <div class="table-responsive">
        <table  class="table table-bordered table-striped">
<tr>
	<th>Tache</th>
	<th>Activite</th>
	<th>Site</th>  
	<th>Date_debut</th>
	<th>Date_fin</th>
	<th>Completed</th>
<th></th></tr>
@foreach($taches->where('site_id',$site_id) as $item)
<tr>
	<td>{{$item->tache}}</td>
	<td>{{$item->Activite->activite??''}}</td>
	<td>{{$item->Site->nom??''}}</td>
	<td>{{$item->date_debut}}</td>
	<td>{{$item->date_fin}}</td>
	<td>{{$item->completed}}%</td>
<td><a class="btn btn-sm btn-primary"  href="{{route('projet.taches.show',$item->id)}}">Voir</a>
</td>
</tr>
@endforeach
</table></div>
{{$taches->links()}}
    
</div>