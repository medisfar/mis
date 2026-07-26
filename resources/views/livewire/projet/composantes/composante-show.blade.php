<x-slot name="titre">composantes</x-slot>

              <x-slot name="stitre">@include('livewire.projet.menu')</x-slot>
<div>
<table  class="table table-bordered">
<tr>
	<th>Code</th>
	<td>{{$composante->code}}</td>
</tr>
<tr>
	<th>Description</th>
	<td>{{$composante->description}}</td>
</tr>
<tr>
	<th>Projet</th>
	<td>{{$composante->projet->code??''}}</td>
	<td>{{$composante->projet_id}}</td>
</tr>
</table>
<a class="btn btn-sm btn-primary" href="{{route('projet.composantes')}}">Liste</a>
<a class="btn btn-sm btn-primary" href="{{route('projet.composantes.edit',$composante->id)}}"><i class="fas fa-edit"></i></button>
 <button  class="btn btn-sm btn-danger" wire:click="destroyComposante({{$composante->id}})"><i class="fas fa-trash"></i></button>  
 <a class="btn btn-sm btn-info" href="{{route('projet.activites.add',['idm'=>$composante->id])}}">Ajouter activite</a>
 <br><br>
 <h4>Activites</h4>
 <table  class="table table-bordered table-striped">
<tr>
	<th>Activite</th>
	<th>Sous composante</th>
	<th>Date debut</th>
	<th>Date fin</th>
	<th>Completed</th>
<th></th></tr>
@foreach($composante->activites as $item)
<tr>
	<td>{{$item->activite}}</td>
	<td>{{$item->souscomposante->code??''}}</td>
	<td>{{$item->date_debut}}</td>
	<td>{{$item->date_fin}}</td>
	<td>{{$item->completed}}%</td>
	
<td><a class="btn btn-sm btn-primary"  href="{{route('projet.activites.show',$item->id)}}">Voir</a>
</td>
</tr>
@endforeach
</table>
</div>