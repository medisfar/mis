<x-slot name="titre">Les sessions</x-slot>

              <x-slot name="stitre">@include('livewire.datacollect.menu')</x-slot>
<div>
<button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Ajouter', 
content: {
type: 'component',
 name: 'datacollect.lessessions.lessession-add',
key: {{ rand(0,1000) }},
params: {}
 }
})">Ajouter</button><br><br>


     <div class="row mb-3">
        <x-select nc="3" label="Localite" fd="localite_id" :options="$locs"></x-select>
     <x-select nc="3" label="Site" fd="site_id" :options="\App\Models\Site::where('projet_id', session()->get('pid'))->where('localite_id', $localite_id)->pluck('nom', 'id')"></x-select>
        <x-select nc="3" label="Groupement" fd="groupement_id" 
            :options="$site_id ? \App\Models\Groupement::where('projet_id', session()->get('pid'))->where('site_id', $site_id)->pluck('nom_groupe', 'id') : []">
        </x-select>
       
 </div>
   
<div class="row">
    <x-rowb 
        label="Sites: {{ $stats['sites'] }}"
        icon="bi bi-cpu" 
        value="Foyers: {{ $stats['foyers'] }}"
        unit=""
    />
    <x-rowb 
        label="Membres : {{ $stats['membres'] }}"
        icon="bi bi-cash" 
         value="Référés : {{ $stats['referes'] }}"
        unit=""
    />
    
    <x-rowb 
        label="Cr normal : {{ $stats['croissance_normale'] }}"
        icon="bi bi-hdd-stack" 
          value="Cr retard : {{ $stats['retard_croissance'] }}"
         unit=""
       
    />
    
    <x-rowb 
        label="taux participations" 
        icon="bi bi-people"
        value="{{ $stats['taux_participation'] }}"
        unit="%"
    />
</div>
<div class="table-responsive">     
   
<table  class="table table-bordered table-striped table-sm">
<tr>
	<th>Type session</th>
	<th>Site</th>
	<th>Date_session</th>
	<th>Groupement</th>
	<th>Participation</th><th></th>
<th></th></tr>
@foreach($lessessions as $item)
<tr>
	<td>{{$item->typesession->nom??''}}</td>
	<td>{{$item->Site->nom??''}}</td>
	<td>{{$item->date_session}}</td>
	<td>{{$item->Groupement->nom_groupe??''}}</td>

		<td>{{count($item->donnees)}}/{{count($item->groupement->membres)}}</td>
	 <td><a class="btn btn-sm btn-success" href="{{route('select.membres',['sid'=>$item->id,'gid'=>$item->groupement_id])}}">Saisir</a></td>
<td>
<div wire:key="{{'s'.$item->id}}">
		<button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Donnees', 
content: {
type: 'component',
 name: 'show-membres',
key: {{ rand(0,1000) }},
params: {sid:{{$item->id}},gid:{{$item->groupement_id}}}
 }
})">Donnees</button>
	<button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Modifier', 
content: {
type: 'component',
 name: 'datacollect.lessessions.lessession-edit',
key: {{ rand(0,1000) }},
params: {id:{{$item->id}}}
 }
})"><i class="fas fa-edit"></i>
</button> <button  class="btn btn-sm btn-danger" wire:confirm="êtes-vous sûr de vouloir supprimer" wire:click="destroyLessession({{$item->id}})"><i class="fas fa-trash"></i></button>  
</div>
</td>
</tr>
@endforeach
</table></div>{{ $lessessions->links() }}
    
</div>
