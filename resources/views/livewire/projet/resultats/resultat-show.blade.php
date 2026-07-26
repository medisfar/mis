<x-slot name="titre">Resultats</x-slot>

              <x-slot name="stitre">@include('livewire.projet.menu')</x-slot>
<div>
<table  class="table table-bordered">
<tr>
	<th>Description</th>
	<td>{{$resultat->description}}</td>
</tr>
</table>

<div class="row">
    
<x-select nc="6" label="Produit" fd="ppid" :options="\App\Models\Produit::pluck('description','id')"></x-select>
<div class="col-md-2">
    <label>Action</label>
<button class="form-control btn btn-sm btn-success"  wire:click="add()">Ajouter</button>
</div></div>
<table class="table">
    <tr><th>Produits</th></tr>

@foreach($resultat->produits as $prd)
<tr>
      
    <td>{{$prd->description}}</td>
      <td><button class="form-control btn btn-sm btn-danger"  wire:click="del({{$prd->id}})"><i class="fa fa-trash"></i></button></td>
</tr>
@endforeach
</table>

<hr>
<div class="row">
<x-select nc="6" label="ODD" fd="odid" :options="\App\Models\Odd::pluck('nom','id')"></x-select>
<div class="col-md-2">
    <label>Action</label>
<button class="form-control btn btn-sm btn-success"  wire:click="addo()">Ajouter</button>
</div></div>
<table class="table">
    <tr><th>ODD</th></tr>

@foreach($resultat->odds as $prd)
<tr>
      
    <td>{{$prd->nom}}</td>
      <td><button class="form-control btn btn-sm btn-danger"  wire:click="delo({{$prd->id}})"><i class="fa fa-trash"></i></button></td>
</tr>
@endforeach
</table>
</div>