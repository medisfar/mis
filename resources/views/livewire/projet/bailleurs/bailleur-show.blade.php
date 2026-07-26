<x-slot name="titre">Bailleurs</x-slot>

              <x-slot name="stitre">@include('livewire.projet.menu')</x-slot>
<div>
<table  class="table table-bordered">
<tr>
	<th>Code</th>
	<td>{{$bailleur->code}}</td>
</tr>
<tr>
	<th>Nom_bailleur</th>
	<td>{{$bailleur->nom_bailleur}}</td>
</tr>
</table>
<a class="btn btn-sm btn-primary" href="{{route('projet.bailleurs')}}">Liste</a>
<a class="btn btn-sm btn-primary" href="{{route('projet.bailleurs.edit',$bailleur->id)}}"><i class="fas fa-edit"></i></button>
 <button  class="btn btn-sm btn-danger" wire:click="destroyBailleur({{$bailleur->id}})"><i class="fas fa-trash"></i></button>  
</div>