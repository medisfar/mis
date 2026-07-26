<x-slot name="titre">Missions</x-slot>

              <x-slot name="stitre">@include('livewire.monitoring.menu')</x-slot>
<div>

<a class="btn btn-sm btn-success" href="{{route('monitoring.missions.add')}}">Ajouter</a>
<br><br>
<input type="text" wire:model.live="search"/>
        <div class="table-responsive">
        <table  class="table table-bordered table-striped">
<tr>
	<th>Libelle</th>
	<th>Description</th>
<th></th></tr>
@foreach($missions as $item)
<tr>
	<td>{{$item->libelle}}</td>
	<td>{{$item->description}}</td>
<td><a class="btn btn-sm btn-primary"  href="{{route('monitoring.missions.show',$item->id)}}">Voir</a>
</td>
</tr>
@endforeach
</table></div>
{{$missions->links()}}
    
</div>