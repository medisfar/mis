<div>
<br><br>

  <div class="row mb-3">
        <x-select nc="3" label="Localite" fd="lid" :options="$locs"></x-select>
     <x-select nc="3" label="Site" fd="siid" :options="\App\Models\Site::where('projet_id', session()->get('pid'))->where('localite_id', $lid)->pluck('nom', 'id')"></x-select>
          
 </div>     
 
<div class="table-responsive">
<table  class="table table-bordered table-striped">
<tr><th>Localite</th>

	<th>Site</th>	<th>Nom_groupe</th>
	<th>Membres</th>
<th></th></tr>
@foreach($groupements as $item)
<tr>	<td>{{$item->site->localite->nom_localite??''}}</td>

	<td>{{$item->Site->nom??''}}</td>	<td>{{$item->nom_groupe}}</td>
	<td>{{$item->membres->count()}}</td>
	<td>
<button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'show', 
content: {
type: 'component',
 name: 'beneficiaire.groupements.groupement-show',
key: 'mbshow',
params: {id:{{$item->id}}}
 }
})">show</button></td>
</tr>
@endforeach
</table></div>
{{$groupements->links()}}
    
</div>
