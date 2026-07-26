<x-slot name="titre">Menages</x-slot>

           
<div>
<table  class="table table-bordered">
<tr>
	<th>Toit</th>
	<td>{{$menage->toit->adresse??''}}</td>
	<td>{{$menage->toit_id}}</td>
</tr>
<tr>
	<th>Chef</th>
	<td>{{$menage->chef}}</td>
</tr>
</table>
<a class="btn btn-sm btn-primary" href="{{route('beneficiaire.menages')}}">Liste</a>
<a class="btn btn-sm btn-primary" href="{{route('beneficiaire.menages.edit',$menage->id)}}"><i class="fas fa-edit"></i></button>
 <button  class="btn btn-sm btn-danger" wire:click="destroyMenage({{$menage->id}})"><i class="fas fa-trash"></i></button>  
</div>