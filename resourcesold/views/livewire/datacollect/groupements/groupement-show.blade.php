<x-slot name="titre">Groupements</x-slot>

              <x-slot name="stitre">@include('livewire.datacollect.menu')</x-slot>
<div>
<table  class="table table-bordered">
<tr>
	<th>Nom_groupe</th>
	<td>{{$groupement->nom_groupe}}</td>
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
<a class="btn btn-sm btn-primary" href="{{route('datacollect.groupements.edit',$groupement->id)}}">Modifier</a>
 <button  class="btn btn-sm btn-danger" wire:click="destroyGroupement({{$groupement->id}})">Supprimer</button>  
 <a class="btn btn-sm btn-primary" href="{{route('datacollect.groupements.groupement-add-membres',$groupement->id)}}">Ajouter membres</a>
 <div class="table-responsive">
 <table  class="table table-bordered table-striped">
 <tr>
 	<th>Menage</th>
 	<th>Genre</th>
 	<th>Nom</th>
 	<th>Date_naissance</th>
 	<th>Lien_parente</th>
 	<th>Enceinte</th>
 <th></th></tr>
 @foreach($groupement->membres as $item)
 <tr>
 	<td>{{$item->menage_id??''}}</td>
 	<td>{{$item->genre==1?'M':'F'}}</td>
 	<td>{{$item->nom}}</td>
 	<td>{{$item->date_naissance}}</td>
 	<td>{{$item->lelien_parente}}</td>
 	<td>{{$item->enceinte==0?'Non':'Oui'}}</td>
 	
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
 })">Modifier</button>

 <button  class="btn btn-sm btn-danger" wire:confirm="êtes-vous sûr de vouloir supprimer" wire:click="destroyMembre({{$item->id}})">Supprimer</button>  
 </td>
 </tr>
 @endforeach
 </table></div>
</div>