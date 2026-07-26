<x-slot name="titre">composantes</x-slot>

              <x-slot name="stitre">@include('livewire.projet.menu')</x-slot>
<div>

<a class="btn btn-sm btn-success" href="{{route('projet.composantes.add')}}">Ajouter</a>
<br><br>
<input type="text" wire:model="search"/>
        <div class="table-responsive">
        <table  class="table table-bordered table-striped">
<tr>
	<th>Code</th>
	<th>Description</th>
	<th>Projet</th>
<th></th></tr>
@foreach($composantes as $item)
<tr>
	<td>{{$item->code}}</td>
	<td>{{$item->description}}</td>
	<td>{{$item->Projet->nom_projet??''}}</td>
<td><a class="btn btn-sm btn-primary"  href="{{route('projet.composantes.show',$item->id)}}">Voir</a>
</td>
</tr>
@endforeach
</table></div>
{{$composantes->links()}}
    
</div>