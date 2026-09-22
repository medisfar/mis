<x-slot name="titre">Epargnes</x-slot>

              <x-slot name="stitre">@include('livewire.microfinance.menu')</x-slot>
<div>
<table  class="table table-bordered">
<tr>
	<th>Membre</th>
	<td>{{$epargne->membre->menage_id??''}}</td>
	<td>{{$epargne->membre_id}}</td>
</tr>
<tr>
	<th>Date_operation</th>
	<td>{{$epargne->date_operation}}</td>
</tr>
<tr>
	<th>Type</th>
	<td>{{$epargne->type}}</td>
</tr>
<tr>
	<th>Montant</th>
	<td>{{$epargne->montant}}</td>
</tr>
</table>
<a class="btn btn-sm btn-primary" href="{{route('microfinance.epargnes')}}">Liste</a>
<a class="btn btn-sm btn-primary" href="{{route('microfinance.epargnes.edit',$epargne->id)}}">Modifier</a>
 <button  class="btn btn-sm btn-danger" wire:click="destroyEpargne({{$epargne->id}})">Supprimer</button>  
</div>