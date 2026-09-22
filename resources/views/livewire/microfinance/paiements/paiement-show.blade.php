<x-slot name="titre">Paiements</x-slot>

              <x-slot name="stitre">@include('livewire.microfinance.menu')</x-slot>
<div>
<table  class="table table-bordered">
<tr>
	<th>Credit</th>
	<td>{{$paiement->credit_id}}</td>
</tr>
<tr>
	<th>Date_paiement</th>
	<td>{{$paiement->date_paiement}}</td>
</tr>
<tr>
	<th>Montant_paye</th>
	<td>{{$paiement->montant_paye}}</td>
</tr>
<tr>
	<th>Montant_restant</th>
	<td>{{$paiement->montant_restant}}</td>
</tr>
</table>
<a class="btn btn-sm btn-primary" href="{{route('microfinance.paiements')}}">Liste</a>
<a class="btn btn-sm btn-primary" href="{{route('microfinance.paiements.edit',$paiement->id)}}">Modifier</a>
 <button  class="btn btn-sm btn-danger" wire:click="destroyPaiement({{$paiement->id}})">Supprimer</button>  
</div>