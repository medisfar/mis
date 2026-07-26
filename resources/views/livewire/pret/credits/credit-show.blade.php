<x-slot name="titre">Credits</x-slot>

              <x-slot name="stitre">@include('livewire.datacollect.menu')</x-slot>
<div>
<table  class="table table-bordered">
<tr>
	<th>Membre</th>
	<td>{{$credit->membre->menage_id??''}}</td>
	<td>{{$credit->membre_id}}</td>
</tr>
<tr>
	<th>Date_credit</th>
	<td>{{$credit->date_credit}}</td>
</tr>
<tr>
	<th>Montant</th>
	<td>{{$credit->montant}}</td>
</tr>
<tr>
	<th>Nbre_echeance</th>
	<td>{{$credit->nbre_echeance}}</td>
</tr>
</table>
<a class="btn btn-sm btn-primary" href="{{route('pret.credits')}}">Liste</a>
<a class="btn btn-sm btn-primary" href="{{route('pret.credits.edit',$credit->id)}}"><i class="fas fa-edit"></i></button>
 <button  class="btn btn-sm btn-danger" wire:click="destroyCredit({{$credit->id}})"><i class="fas fa-trash"></i></button>  
</div>