<x-slot name="titre">Produits</x-slot>

              <x-slot name="stitre">@include('livewire.projet.menu')</x-slot>
<div>
<table  class="table table-bordered">

<tr>
	<th>Description</th>
	<td>{{$produit->description}}</td>
</tr>
</table>
<div class="row">
    
<x-select nc="3" label="Composante" fd="cpid" :options="\App\Models\Composante::where('projet_id',session()->get('pid'))->pluck('code','id')"></x-select>
<x-select nc="6" label="Activite" fd="activite_id" :options="\App\Models\Activite::where('composante_id',$cpid)->pluck('activite','id')"></x-select>
<div class="col-md-2">
    <label>Action</label>
<button class="form-control btn btn-sm btn-success"  wire:click="add()">Ajouter</button>
</div></div>
<table class="table">
    <tr><th>Composante</th><th>Activite</th></tr>

@foreach($produit->activites as $act)
<tr>
      <td>{{$act->composante->code}}</td>
    <td>{{$act->activite}}</td>
    <td><button class="form-control btn btn-sm btn-danger"  wire:click="del()"><i class="fa fa-trash"></i></button></td>
</tr>
@endforeach
</table>
</div>