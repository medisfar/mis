<x-slot name="titre">Souscomposantes</x-slot>

              <x-slot name="stitre">@include('livewire.projet.menu')</x-slot>
<div>

<a class="btn btn-sm btn-success" href="{{route('projet.souscomposantes.add')}}">Ajouter</a>
<br><br>
<input type="text" wire:model="search"/>
        <div class="table-responsive">
        <table  class="table table-bordered table-striped">
<tr>
	<th>Code</th>
	<th>Description</th>
	<th>Composante</th>
<th></th></tr>
@foreach($souscomposantes as $item)
<tr>
	<td>{{$item->code}}</td>
	<td>{{$item->description}}</td>
	<td>{{$item->Composante->code??''}}</td>
<td><a class="btn btn-sm btn-primary"  href="{{route('projet.souscomposantes.show',$item->id)}}">Voir</a>
</td>
</tr>
@endforeach
</table></div>
{{$souscomposantes->links()}}
    
</div>