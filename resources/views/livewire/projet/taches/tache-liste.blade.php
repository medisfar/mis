<div>

<button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Ajouter', 
content: {
type: 'component',
 name: 'projet.taches.tache-add',
key: 'tache-add',
params: {}
 }
})">Ajouter</button>
<div class="row">

<x-select nc="3" label="Composante" fd="cpid" :options="\App\Models\Composante::where('projet_id',session()->get('pid'))->pluck('description','id')"></x-select>
<x-select nc="3" label="Activite" fd="activite_id" :options="\App\Models\Activite::where('composante_id',$cpid)->pluck('activite','id')"></x-select>
<x-select nc="3" label="Site" fd="site_id" :options="\App\Models\Site::where('projet_id',session()->get('pid'))->pluck('nom','id')"></x-select>
 </div>       <div class="table-responsive">
        <table style="table-layout:fixed; width:100%" class="table table-bordered table-striped task-table program-table">
<tr>
	<th style="width:20%!important">Sous-activité</th>
	<th style="width:20%">Activite</th>
	<th>Site</th>  
	<th>Debut</th>
	<th>Fin</th>
	<th>Budget (USD)</th>
	<th>Engagé (USD)</th>
	<th class="task-progress-heading">Avancement</th>
<th></th></tr>
@foreach($taches as $item)
<tr>
	<td>{{$item->tache}}</td>
	<td>{{$item->Activite->activite??''}}</td>
	<td>{{$item->Site->nom??''}}</td>
	<td>{{$item->date_debut}}</td>
	<td>{{$item->date_fin}}</td>
		<td class="nbre">{{ \App\Uts::nbf($item->budget) }} $</td>
			<td class="nbre">{{ \App\Uts::nbf($item->engage) }} $</td>
	@php $progress = max(0, min(100, (float) $item->completed)); @endphp
	<td class="task-progress-cell">
		<div class="task-progress-content">
			<div class="progress" role="progressbar" aria-label="Avancement" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100">
				<div class="progress-bar" style="width: {{ $progress }}%"></div>
			</div>
			<span class="task-progress-value">{{ $progress }}%</span>
		</div>
	</td>
<td><button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Modifier', 
content: {
type: 'component',
 name: 'projet.taches.tache-edit',
key: 'tache-edit.{{$item->id}}',
params: {id:{{$item->id}}}
 }
})"><i class="fas fa-edit"></i></button> <button  class="btn btn-sm btn-danger" wire:key="bt{{$item->id}}" wire:confirm="锚tes-vous s没r de vouloir supprimer" wire:click="destroyTache({{$item->id}})"><i class="fas fa-trash"></i></button>  
</td>
</tr>
@endforeach
</table></div><div>
{{ $taches->links('pagination::bootstrap-5') }}</div>
    
</div>
