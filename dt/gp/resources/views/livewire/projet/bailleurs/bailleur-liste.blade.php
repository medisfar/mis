<x-slot name="titre">Bailleurs</x-slot>

              <x-slot name="stitre">@include('livewire.projet.menu')</x-slot>
<div>

<a class="btn btn-sm btn-success" href="{{route('projet.bailleurs.add')}}">Ajouter</a>
<br><br>
<input type="text" wire:model.live="search"/>
        <div class="table-responsive">
        <table  class="table table-bordered table-striped">
<tr>
	<th>Code</th>
	<th>Nom_bailleur</th>
<th></th></tr>
@foreach($bailleurs as $item)
<tr>
	<td>{{$item->code}}</td>
	<td>{{$item->nom_bailleur}}</td>
<td><a class="btn btn-sm btn-primary"  href="{{route('projet.bailleurs.show',$item->id)}}">Voir</a>
</td>
</tr>
@endforeach
</table></div>
{{$bailleurs->links()}}
    
</div>