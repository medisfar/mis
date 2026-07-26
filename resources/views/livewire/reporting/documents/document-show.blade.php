<x-slot name="titre">Documents</x-slot>

              <x-slot name="stitre">@include('livewire.reporting.menu')</x-slot>
<div>
<table  class="table table-bordered">
<tr>
	<th>Projet</th>
	<td>{{$document->projet->code??''}}</td>
	<td>{{$document->projet_id}}</td>
</tr>
<tr>
	<th>Titre</th>
	<td>{{$document->titre}}</td>
</tr>
<tr>
	<th>Fichier</th>
	<td>{{$document->fichier}}</td>
</tr>
</table>
<a class="btn btn-sm btn-primary" href="{{route('reporting.documents')}}">Liste</a>
<a class="btn btn-sm btn-primary" href="{{route('reporting.documents.edit',$document->id)}}">Modifier</a>
 <button  class="btn btn-sm btn-danger" wire:click="destroyDocument({{$document->id}})">Supprimer</button>  
</div>