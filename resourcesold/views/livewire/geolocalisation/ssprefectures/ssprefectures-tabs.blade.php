<div><br>
@livewire('lamodal',['key'=>'spa','label'=>'Ajouter ssprefecture','cmp'=>'geolocalisation.ssprefectures.ssprefecture-add','params'=>[]])

<table  class="table table-bordered table-striped">
<tr>
	<th>Prefecture</th>
	<th>Code</th>
	<th>Nom_ssprefecture</th>
	<th>Type</th>
<th></th></tr>
@foreach($ssprefectures as $item)
<tr>
	<td>{{$item->Prefecture->nom_prefecture??''}}</td>
	<td>{{$item->code}}</td>
	<td>{{$item->nom_ssprefecture}}</td>
	<td>{{$item->letype}}</td>
<td>
@livewire('lamodal',['key'=>'spmss'.$item->id,'label'=>'Modifier','cmp'=>'geolocalisation.ssprefectures.ssprefecture-edit','params'=>['id'=>$item->id]])
</td>
<td>
 <button  class="flex-item btn btn-sm btn-danger" wire:click="destroyRegion({{$item->id}})">Supprimer</button> 
</td>
</tr>
@endforeach

</table>

{{$ssprefectures->appends(request()->except('page'))->links()}}</div>