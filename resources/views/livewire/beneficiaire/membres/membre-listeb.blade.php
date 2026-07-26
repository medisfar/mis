<div>

<a class="btn btn-sm btn-success" href="{{route('beneficiaire.membres.add')}}">Ajouter</a>
<br><br>
<input type="text" wire:model.live="search"/>
        <div class="table-responsive">
        <table  class="table table-bordered table-striped">
<tr>
	
	<th>Genre</th>
	<th>Nom</th>
	<th>Date_naissance</th>
	<th>Lien_parente</th>
	<th>Enceinte</th>
<th></th></tr>
@foreach($membres as $item)
<tr>
	
	<td>{{$item->genre==0?'Feminin':'Masculin'}}</td>
	<td>{{$item->nom}}</td>
	<td>{{$item->date_naissance}}</td>
	<td>{{$item->laparente}}</td>
	<td>{{$item->enceinte==0?'Non':'Oui'}}</td>
<td><a class="btn btn-sm btn-primary"  href="{{route('beneficiaire.membres.show',$item->id)}}">Voir</a>
</td>
</tr>
@endforeach
</table></div>

    
</div>