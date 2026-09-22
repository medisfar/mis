<x-slot name="titre">Echeances</x-slot>

              <x-slot name="stitre">@include('livewire.microfinance.menu')</x-slot>
<div>
<table  class="table table-bordered">
<tr>
	<th>Date_echeance</th>
	<td>{{$echeance->date_echeance}}</td>
</tr>
<tr>
	<th>Montant_paye</th>
	<td>{{$echeance->montant_paye}}</td>
</tr>
</table>
<a class="btn btn-sm btn-primary" href="{{route('microfinance.echeances')}}">Liste</a>
<a class="btn btn-sm btn-primary" href="{{route('microfinance.echeances.edit',$echeance->id)}}">Modifier</a>
 <button  class="btn btn-sm btn-danger" wire:click="destroyEcheance({{$echeance->id}})">Supprimer</button>  
</div>