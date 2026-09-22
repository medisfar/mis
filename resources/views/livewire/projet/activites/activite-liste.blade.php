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
        <table class="table table-bordered table-striped activity-table">
<tr class="text-nowrap">
	<th>Activité</th>
	
	
	<th>Dates</th>

	<th>Budget (USD)</th>
	<th>Engagé (USD)</th>
	<th>Décaissé (USD)</th>
	
	<th class="activity-progress">Avancement</th>
	<th>Statut</th>
                <th></th>
            </tr>
        </thead>
@foreach($activites as $item)
<tr>
	
	<td class="activity-name">{{$item->activite}}</td>
	
	
	<td class="activity-dates">du {{$item->date_debut??''}}<br>au {{$item->date_fin??''}}</td>
		

	<td class="nbre">{{ \App\Uts::nbf($item->budget) ?? '' }} $</td>
	<td class="nbre">{{ \App\Uts::nbf($item->engage) ?? '' }} $</td>
	<td class="nbre">{{ \App\Uts::nbf($item->decaisse) ?? '' }} $</td>
	
	@php $progress = max(0, min(100, (float) $item->completed)); @endphp
	<td class="activity-progress">
		<div class="task-progress-content">
			<div class="progress" role="progressbar" aria-label="Avancement" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100">
				<div class="progress-bar" style="width: {{ $progress }}%"></div>
			</div>
			<span class="task-progress-value">{{ $progress }}%</span>
		</div>
	</td>
	<td class="activity-status">{{$item->lestatut}}</td>
<td class="activity-actions"><a class="btn btn-sm btn-primary"  href="{{route('projet.activites.show',$item->id)}}">Voir</a>

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
