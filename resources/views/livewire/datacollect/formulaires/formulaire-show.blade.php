<x-slot name="titre">Formulaires</x-slot>

              
<div>
<table  class="table table-bordered">
<tr>
	<th>Nom</th>
	<td>{{$formulaire->nom}}</td>
</tr>
<tr>
	<th>Projet</th>
	<td>{{$formulaire->projet->code??''}}</td>
	<td>{{$formulaire->projet_id}}</td>
</tr>
<tr>
	<th>Fields</th>
	<td>{{$formulaire->fields}}</td>
</tr>
<tr>
	<th>Actif</th>
	<td>{{$formulaire->actif}}</td>
</tr>
</table>
<a class="btn btn-sm btn-primary" href="{{route('datacollect.formulaires')}}">Liste</a>
<a class="btn btn-sm btn-primary" href="{{route('datacollect.formulaires.edit',$formulaire->id)}}"><i class="fas fa-edit"></i></button>
 <button  class="btn btn-sm btn-danger" wire:click="destroyFormulaire({{$formulaire->id}})"><i class="fas fa-trash"></i></button>  
</div>