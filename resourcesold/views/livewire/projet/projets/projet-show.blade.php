<x-slot name="titre">Projets</x-slot>

              <x-slot name="stitre">@include('livewire.projet.menu')</x-slot>
<div>
<table  class="table table-bordered">


<tr>
	<th>Nom_projet</th>
	<td>{{$projet->nom_projet}}</td>
</tr>
<tr>
	<th>Objectifs</th>
	<td>{{$projet->objectifs}}</td>
</tr>

<tr>
	<th>Budget</th>
	<td>{{$projet->budget}}</td>
</tr>
<tr>
	<th>Date_debut</th>
	<td>{{$projet->date_debut}}</td>
</tr>
<tr>
	<th>Date_fin</th>
	<td>{{$projet->date_fin}}</td>
</tr>
<tr>
	<th>Statut</th>
	<td>{{$projet->lestatut}}</td>
</tr>
<tr>
	<th>Commentaire</th>
	<td>{{$projet->commentaire}}</td>
</tr>
</table>

<a class="btn btn-sm btn-primary" href="{{route('projet.projets.edit',$projet->id)}}">Modifier</a>
 <button  class="btn btn-sm btn-danger" wire:click="destroyProjet({{$projet->id}})">Supprimer</button>  
<div class="row" style="background:blue;color:white">
 	<x-select nc="3" label="Bailleur" fd="b" :options="\App\Models\Bailleur::tab()"></x-select>
 	<x-field nc="3" label="Montant" fd="mtn"></x-field>
 	<x-field nc="3" label="Date" fd="date_f"></x-field>
 	<div class="col-md-2">
 		<label>Action</label>
 	<button  class="form-control btn btn-sm btn-success" wire:click="add">Ajouter</button> </div>
 </div><br><br>
 <table class="table">
	<tr>
		<th>Bailleur</th>
		<th>Budget</th>
		<th>Date</th>
	</tr>
	@foreach($projet->bailleurs as $b)
	<tr>
		<td>{{$b->code}}</td>
		<td>{{$b->pivot->budget}}</td>
		<td>{{$b->pivot->date_f}}</td>
		<td><button  class="form-control btn btn-sm btn-danger" wire:click="del({{$b->id}})">Supprimer</button></td>
	</tr>
	@endforeach
	</table>
 </div>
</div>