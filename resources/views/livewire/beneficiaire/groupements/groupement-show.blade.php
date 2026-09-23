<x-slot name="titre">Groupements</x-slot>

              <x-slot name="stitre">@include('livewire.projet.menu')</x-slot>
<div>
<table  class="table table-bordered">
<tr>
	<th>Nom_groupe</th>
	<td>{{$groupement->nom_groupe}}</td>
</tr>
<tr>
	<th>Mère conseillère</th>
	<td>{{$groupement->mere_conseillere ?? ''}}</td>
</tr>
<tr>
	<th>Nombre de membres</th>
	<td>{{$groupement->membres->count()}}</td>
</tr>
<tr>
	<th>Site</th>
	<td>{{$groupement->site->nom??''}}</td>
	<td>{{$groupement->site_id}}</td>
</tr>
<tr>
	<th>Statut</th>
	<td>{{$groupement->statut}}</td>
</tr>
</table>
<a class="btn btn-sm btn-primary" href="{{route('datacollect.groupements')}}">Liste</a>
<a class="btn btn-sm btn-primary" href="{{route('datacollect.groupements.addmembres',$groupement->id)}}">Ajouter membres</a>
<a class="btn btn-sm btn-primary" href="{{route('datacollect.groupements.edit',$groupement->id)}}"><i class="fas fa-edit"></i></a>
 <button  class="btn btn-sm btn-danger" wire:click="destroyGroupement({{$groupement->id}})"><i class="fas fa-trash"></i></button>  
 <div class="table-responsive">
 <table  class="table table-bordered table-striped">
 <tr>
 	<th>Menage</th>
	<th>Foyer</th>
 	<th>Genre</th>
 	<th>Nom</th>
 	<th>Date_naissance</th>
 	<th>Lien_parente</th>
 	
 <th></th></tr>
 @foreach($groupement->membres as $item)
 <tr>
 	<td>{{$item->menage_id??''}}</td>
	 <td>{{$item->groupement->first()->nom_groupe??''}}</td>
 	<td>{{$item->genre==1?'M':'F'}}</td>
 	<td>{{$item->nom}}</td>
 	<td>{{$item->date_naissance}}</td>
 	<td>{{$item->lelien_parente}}</td>
 
 	
 <td>
     
     <button class="btn btn-sm btn-success"
 wire:click="$dispatch('show-modal', { 
 title: 'Modifier', 
 content: {
 type: 'component',
  name: 'datacollect.membres.membre-edit',
 key: {{ rand(0,1000) }},
 params: {id:{{$item->id}}}
  }
 })"><i class="fas fa-edit"></i></button>

 <button  class="btn btn-sm btn-danger" wire:confirm="锚tes-vous s没r de vouloir supprimer" wire:click="destroyMembre({{$item->id}})"><i class="fas fa-trash"></i></button>  
 </td>
 </tr>
 @endforeach
 </table></div>
</div>
