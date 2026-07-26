<div>
@livewire('lamodal',['key'=>'pa','label'=>'Ajouter prefecture','cmp'=>'geolocalisation.prefectures.prefecture-add','params'=>[]])

        <div class="table-responsive">
        <table  class="table table-bordered table-striped">
<tr>
	<th>Region</th>
	<th>Code</th>
	<th>Nom_prefecture</th>
	<th>Type</th>
<th></th></tr>
@foreach($prefectures as $item)
<tr>
	<td>{{$item->Region->nom_region??''}}</td>
	<td>{{$item->code}}</td>
	<td>{{$item->nom_prefecture}}</td>
	<td>{{$item->letype}}</td>
<td>
@livewire('lamodal',['key'=>'pm'.$item->id,'label'=>'Modifier','cmp'=>'geolocalisation.prefectures.prefecture-edit','params'=>['id'=>$item->id]])
</td>
<td>
 <button  class="flex-item btn btn-sm btn-danger" wire:click="destroyRegion({{$item->id}})">Supprimer</button> 
</td>
</tr>
@endforeach
</table></div>
</div>