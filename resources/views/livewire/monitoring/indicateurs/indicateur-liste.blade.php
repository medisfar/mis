<x-slot name="titre">Indicateurs</x-slot>

              <x-slot name="stitre">@include('livewire.monitoring.menu')</x-slot>
              <div> 
<div class="table-responsive">
<table  class="table table-bordered table-striped">
<tr>
	<th width="40%">Nom</th>
	
	<th>Frequence</th>
		<th>Cible finale</th>
			<th>Valeur actuelle</th>
	
<th></th></tr>
@foreach($indicateurs as $item)
<tr>
	<td>{{$item->nom}}</td>

	<td>{{$item->lafrequence}}</td>
	<td>{{$item->cible_finale}}</td>
	<td>{{$item->valeur_actuelle}}</td>
<td>
 <button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
    title: 'Show', 
    content: {
        type: 'component',
        name: 'monitoring.indicateurs.indicateur-show',
        key: {{ rand(0,1000) }},
        params: { id: {{ $item->id }} }
    }
})"><i class="fas fa-eye"></i></button>
</td>
</tr>
@endforeach
</table></div>
{{$indicateurs->links()}}
    
</div>