<div>
<button class="btn btn-sm btn-success"
    wire:click="$dispatch('show-modal', { 
        title: 'Modifier', 
        content: {
            type: 'component',
            name: 'geolocalisation.regions.region-add',
            key: {{ rand(0,1000) }},
            params: {}
        }
    })"
>
    Ajouter
</button>       <div class="table-responsive">
        <table  class="table table-bordered table-striped">
<tr>
	<th>Code</th>
	<th>Nom_region</th>
<th></th></tr>

@foreach($regions as $item)
    <tr>
        <td>{{ $item->code }}</td>
        <td>{{ $item->nom_region }}</td>
        <td>
        <button class="btn btn-sm btn-info"
    wire:click="$dispatch('show-modal', { 
        title: 'Modifier', 
        content: {
            type: 'component',
            name: 'geolocalisation.regions.region-edit',
            key: {{ $item->id }}{{ rand(0,1000) }},
            params: {id:{{ $item->id }}}
        }
    })"
>
    <i class="fas fa-edit"></i></button>
         <a class="btn btn-sm btn-danger" wire:click="destroyRegion({{ $item->id }})"><i class="fas fa-trash"></i></a>
        </td>
    </tr>
@endforeach
</table></div>
{{$regions->links()}}
    
</div>