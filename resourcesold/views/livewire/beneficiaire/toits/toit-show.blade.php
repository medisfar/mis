<x-slot name="titre">Toits</x-slot>


<div>
<table  class="table table-bordered">
<tr>
	<th>Adresse</th>
	<td>{{$toit->adresse}}</td>
</tr>
</table>
<a class="btn btn-sm btn-primary" href="{{route('beneficiaire.toits')}}">Liste</a>
<a class="btn btn-sm btn-primary" href="{{route('beneficiaire.toits.edit',$toit->id)}}">Modifier</a>
 <button  class="btn btn-sm btn-danger" wire:click="destroyToit({{$toit->id}})">Supprimer</button>  
</div>