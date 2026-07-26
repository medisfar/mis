<x-slot name="titre">Sites</x-slot>

              <x-slot name="stitre">@include('livewire.beneficiaire.menu')</x-slot>
<div>
<table  class="table table-bordered">
<tr>
	<th>Nom</th>
	<td>{{$site->nom}}</td>
</tr>
<tr>
	<th>Activite</th>
	<td>{{$site->activite->activite??''}}</td>
	<td>{{$site->activite_id}}</td>
</tr>
</table>
<a class="btn btn-sm btn-primary" href="{{route('beneficiaire.sites')}}">Liste</a>
<a class="btn btn-sm btn-primary" href="{{route('beneficiaire.sites.edit',$site->id)}}"><i class="fas fa-edit"></i></button>
 <button  class="btn btn-sm btn-danger" wire:click="destroySite({{$site->id}})"><i class="fas fa-trash"></i></button>  
</div>