<x-slot name="titre">Activites</x-slot>

              <x-slot name="stitre">@include('livewire.projet.menu')</x-slot>
<div>
<table  class="table table-bordered">

<tr>
	<th>Activite</th>
	<td colspan=3"">{{$uneactivite->activite}}</td>
</tr>
<tr>
	<th>Composante</th>
	<td>{{$uneactivite->composante->code??''}}</td>

	<th>Sous_composante</th>
	<td>{{$uneactivite->souscomposante->code??''}}</td>
	
</tr>
<tr>
	<th>Date_debut</th>
	<td>{{$uneactivite->date_debut}}</td>

	<th>Date_fin</th>
	<td>{{$uneactivite->date_fin}}</td>
</tr>
<tr>
	<th>Budget</th>
	<td>{{$uneactivite->budget}}</td>

	<th>Completed</th>
	<td>{{$uneactivite->completed}}</td>
</tr>
</table>

<button class="btn btn-sm btn-success"
wire:click="$dispatch('show-modal', { 
title: 'Ajouter', 
content: {
type: 'component',
 name: 'projet.activites.activite-edit',
key: {{ rand(0,1000) }},
params: {id:{{$uneactivite->id}}}
 }
})">Modifier</button>
 <button  class="btn btn-sm btn-danger" wire:click="destroyActivite({{$uneactivite->id}})">Supprimer</button> 

 <br><br>
 <div class="row">
	<div class="col-md-6" style="border: solid 1px blueviolet; margin: 1px;">
 <h4>Sites</h4>
 <div class="row"> <x-select fd="nom" label="Nom" nc="6" :options="\App\Models\Site::tab()"></x-select>
 <x-field nc="5" label="Budget" fd="lbudget"></x-field></div>
 <button class="btn btn-sm btn-primary"  wire:click="addsite()">Ajouter</button>
 <button class="btn btn-sm btn-danger"  wire:click="delsite()">Retirer</button>
 <table  class="table table-bordered table-striped">
<tr>
	<th>Nom</th>
	<th>Budget</th>
<th></th></tr>
@foreach($uneactivite->sites as $item)
<tr>
	<td>{{$item->nom??''}}</td>
    <td>{{$item->pivot->budget??''}}</td>


</tr>
@endforeach

</table></div>
	<div class="col-md-5" style="border: solid 1px blueviolet;margin: 1px;">
<h4>Produits</h4> 
 <x-select fd="pnom" :options="\App\Models\Produit::tab()"></x-select>
 <button class="btn btn-sm btn-primary"  wire:click="addproduit()">Ajouter</button>
 <button class="btn btn-sm btn-danger"  wire:click="delproduit()">Retirer</button>
 <table  class="table table-bordered table-striped">
<tr>
	<th>Nom</th>
<th></th></tr>
@foreach($uneactivite->produits as $item)
<tr>
	<td>{{$item->description??''}}</td>


</tr>
@endforeach
</table>
</div></div>
</div>