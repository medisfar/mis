<div>

<button class="btn btn-sm btn-info"
    wire:click="$dispatch('show-modal', { 
        title: 'Modifier', 
        content: {
            type: 'component',
            name: 'geolocalisation.localites.localite-add',
            key: {{ rand(0,1000) }},
            params: {}
        }
    })"
>
    Ajouter
</button>

 <card>Rechercher
jgfcc
     
 </card>       <div class="table-responsive">
        <table  class="table table-bordered table-striped">
<tr>
	<th>Nom localite</th>
	<th>Ssprefecture</th>
    <th>Prefecture</th>
	<th>type</th>
<th></th></tr>
@foreach($localites as $item)
<tr>
	<td>{{$item->nom_localite}}</td>
	<td>{{$item->ssprefecture->nom_ssprefecture??''}}</td>
    <td>{{$item->ssprefecture->prefecture->nom_prefecture??''}}</td>
	<td>{{$item->letype}}</td>
<td>
    <button class="btn btn-sm btn-info"
    wire:click="$dispatch('show-modal', { 
        title: 'Modifier', 
        content: {
            type: 'component',
            name: 'geolocalisation.localites.localite-edit',
            key: {{ $item->id }}{{ rand(0,1000) }},
            params: {id:{{ $item->id }}}
        }
    })"
>
    <i class="fas fa-edit"></i></button>
 <button  class="btn btn-sm btn-danger" wire:click="destroyLocalite({{$item->id}})"><i class="fas fa-trash"></i></button>  
</td>
</tr>
@endforeach
</table></div>
{{$localites->links()}}
    
</div>