<div>
    @livewire('lamodal',['key'=>'pa','label'=>'Ajouter localite','cmp'=>'geolocalisation.localites.localite-add','params'=>[]])
 <table  class="table table-bordered table-striped">
<tr>
	<th>Nom localite</th>
	<th>Ssprefecture</th>
	<th>type</th>
<th></th></tr>
@foreach($localites as $item)
<tr>
	<td>{{$item->nom_localite}}</td>
	<td>{{$item->ssprefecture->nom_ssprefecture??''}}</td>
	<td>{{$item->letype}}</td>
<td>
@livewire('lamodal',['key'=>'spmss'.$item->id,'label'=>'Modifier','cmp'=>'geolocalisation.localites.localite-edit','params'=>['id'=>$item->id]])
</td>
<td>
 <button  class="flex-item btn btn-sm btn-danger" wire:click="destroyRegion({{$item->id}})"><i class="fas fa-trash"></i></button> 
</td>
</tr>
@endforeach
</table></div>