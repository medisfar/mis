<x-slot name="titre">Decomptesi</x-slot>

              <x-slot name="stitre">@include('livewire.projet.menu')</x-slot>
<div>

<a class="btn btn-sm btn-success" href="{{route('projet.decomptes.add')}}">Ajouter</a>
<br><br>
<x-select nc="3" label="Composante" fd="cpid" :options="\App\Models\Composante::where('projet_id',session()->get('pid'))->pluck('description','id')"></x-select>
<x-select nc="3" label="Activite" fd="activite_id" :options="\App\Models\Activite::where('composante_id',$cpid)->pluck('activite','id')"></x-select>
<x-select nc="3" label="Site" fd="site_id" :options="\App\Models\Site::tab()"></x-select>
        <div class="table-responsive">
        <table  class="table table-bordered table-striped">
<tr>
	<th>Activite</th>
	<th>Date_previsionnelle</th>
	<th>Pourcentage</th>
	<th>Date_effective</th>
<th></th></tr>
@foreach($decomptes as $item)
<tr>
	<td>{{$item->Activite->activite??''}}</td>
	<td>{{$item->date_previsionnelle}}</td>
	<td>{{$item->pourcentage}}</td>
	<td>{{$item->date_effective}}</td>
<td><a class="btn btn-sm btn-primary"  href="{{route('projet.decomptes.show',$item->id)}}">Voir</a>
</td>
</tr>
@endforeach
</table></div>
{{$decomptes->links()}}
    
</div>