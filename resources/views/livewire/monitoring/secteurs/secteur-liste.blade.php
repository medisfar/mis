<x-slot name="titre">Secteurs</x-slot>

              <x-slot name="stitre">@include('livewire.monitoring.menu')</x-slot>
<div>

<a class="btn btn-sm btn-success" href="{{route('monitoring.secteurs.add')}}">Ajouter</a>
<br><br>
<input type="text" wire:model.live="search"/>
        <div class="table-responsive">
        <table  class="table table-bordered table-striped">
<tr>
	<th>Nom_secteur</th>
	<th>Mission</th>
<th></th></tr>
@foreach($secteurs as $item)
<tr>
	<td>{{$item->nom_secteur}}</td>
	<td>{{$item->Mission->libelle??''}}</td>
<td><a class="btn btn-sm btn-primary"  href="{{route('monitoring.secteurs.show',$item->id)}}">Voir</a>
</td>
</tr>
@endforeach
</table></div>
{{$secteurs->links()}}
    
</div>