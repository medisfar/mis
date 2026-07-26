<div><br>
<button class="btn btn-sm btn-info"
    wire:click="$dispatch('show-modal', { 
        title: 'Modifier', 
        content: {
            type: 'component',
            name: 'geolocalisation.ssprefectures.ssprefecture-add',
            key: {{ rand(0,1000) }},
            params: {}
        }
    })"
>
    Ajouter
</button>
<table  class="table table-bordered table-striped">
<tr>
	<th>Prefecture</th>
	<th>Code</th>
	<th>Nom_ssprefecture</th>
	<th>Type</th>
<th></th></tr>
@foreach($ssprefectures as $item)
<tr>
	<td>{{$item->Prefecture->nom_prefecture??''}}</td>
	<td>{{$item->code}}</td>
	<td>{{$item->nom_ssprefecture}}</td>
	<td>{{$item->letype}}</td>
<td>
<button class="btn btn-sm btn-info"
    wire:click="$dispatch('show-modal', { 
        title: 'Modifier', 
        content: {
            type: 'component',
            name: 'geolocalisation.ssprefectures.ssprefecture-edit',
            key: {{ $item->id }}{{ rand(0,1000) }},
            params: {id:{{ $item->id }}}
        }
    })"
>
    <i class="fas fa-edit"></i></button>
 <button  class="flex-item btn btn-sm btn-danger" wire:click="destroySsprefecture({{$item->id}})"><i class="fas fa-trash"></i></button> 
</td>
</tr>
@endforeach

</table>

{{$ssprefectures->appends(request()->except('page'))->links()}}</div>