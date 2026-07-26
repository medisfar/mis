<x-slot name="titre">Menages</x-slot>

              <x-slot name="stitre">@include('livewire.geolocalisation.menu')</x-slot>
<div>

<a class="btn btn-sm btn-success" href="{{route('geolocalisation.menages.add')}}">Ajouter</a>
<br><br>
<input type="text" wire:model.live="search"/>
        <div class="table-responsive">
        <table  class="table table-bordered table-striped">
<tr>
	<th>Toit</th>
	<th>Chefa</th>
	<th>Localite</th>
<th></th></tr>
@foreach($menages as $item)
<tr>
	<td>{{$item->Toit->adresse??''}}</td>
	<td>{{$item->chef}}</td>
	<td>{{$item->Localite->nom_localite??''}}</td>
<td><a class="btn btn-sm btn-primary"  href="{{route('geolocalisation.menages.show',$item->id)}}">Voir</a>
</td>
</tr>
@endforeach
</table></div>
{{$menages->links()}}
    
</div>