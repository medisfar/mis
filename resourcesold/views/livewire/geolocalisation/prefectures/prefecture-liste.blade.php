<div>
    
<button class="btn btn-sm btn-info"
    wire:click="$dispatch('show-modal', { 
        title: 'Modifier', 
        content: {
            type: 'component',
            name: 'geolocalisation.prefectures.prefecture-add',
            key: {{ rand(0,1000) }},
            params: {}
        }
    })"
>
    Ajouter
</button>

        <div class="table-responsive">
        <table  class="table table-bordered table-striped">
<tr>
	<th>Region</th>
	<th>Code</th>
	<th>Nom_prefecture</th>
	<th>Type</th>
<th></th></tr>
@foreach($prefectures as $item)
<tr>
	<td>{{$item->Region->nom_region??''}}</td>
	<td>{{$item->code}}</td>
	<td>{{$item->nom_prefecture}}</td>
	<td>{{$item->letype}}</td>
<td>
<button class="btn btn-sm btn-info"
    wire:click="$dispatch('show-modal', { 
        title: 'Modifier', 
        content: {
            type: 'component',
            name: 'geolocalisation.prefectures.prefecture-edit',
            key: {{ $item->id }}{{ rand(0,1000) }},
            params: {id:{{ $item->id }}}
        }
    })"
>
    Modifier
</button>
    
 <button  class="btn btn-sm btn-danger" wire:click="destroyPrefecture({{$item->id}})">Supprimer</button>  
</tr>
@endforeach
</table></div>
{{$prefectures->links()}}
    
</div>