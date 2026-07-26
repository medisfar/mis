<x-slot name="titre">Echeances</x-slot>

              <x-slot name="stitre">@include('livewire.pret.menu')</x-slot>
<div>
<table  class="table table-bordered">
<tr>
	<th>Membre</th>
	<td>{{$echeance->membre->menage_id??''}}</td>
	<td>{{$echeance->membre_id}}</td>
</tr>
<tr>
	<th>Montant</th>
	<td>{{$echeance->montant}}</td>
</tr>
<tr>
	<th>Date_paiement</th>
	<td>{{$echeance->date_paiement}}</td>
</tr>
</table>
<a class="btn btn-sm btn-primary" href="{{route('pret.echeances')}}">Liste</a>
<a class="btn btn-sm btn-primary" href="{{route('pret.echeances.edit',$echeance->id)}}">Modifier</a>
 <button  class="btn btn-sm btn-danger" wire:click="destroyEcheance({{$echeance->id}})">Supprimer</button>  
</div>