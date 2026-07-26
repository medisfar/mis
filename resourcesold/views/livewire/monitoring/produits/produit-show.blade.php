<x-slot name="titre">Produits</x-slot>

              <x-slot name="stitre">@include('livewire.monitoring.menu')</x-slot>
<div>
<table  class="table table-bordered">
<tr>
	<th>Description</th>
	<td>{{$produit->description}}</td>
</tr>
</table>
<a class="btn btn-sm btn-primary" href="{{route('monitoring.produits')}}">Liste</a>
<a class="btn btn-sm btn-primary" href="{{route('monitoring.produits.edit',$produit->id)}}">Modifier</a>
 <button  class="btn btn-sm btn-danger" wire:click="destroyProduit({{$produit->id}})">Supprimer</button>  
</div>