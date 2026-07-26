<div>
@livewire('lamodal',['key'=>'ra','label'=>'Ajouter region','cmp'=>'geolocalisation.regions.region-add','params'=>[]])

<table  class="table table-bordered table-striped">
<tr>
	<th>Code</th>
	<th>Nom_region</th>
<th></th></tr>
@foreach($regions as $item)
<tr>
	<td>{{$item->code}}</td>
	<td>{{$item->nom_region}}</td>
<td>
@livewire('lamodal',['key'=>'rm'.$item->id,'label'=>'Modifier','cmp'=>'geolocalisation.regions.region-edit','params'=>['id'=>$item->id]])
</td>
<td>
 <button  class="flex-item btn btn-sm btn-danger" wire:click="destroyRegion({{$item->id}})">fSupprimer</button> 
</td>
</tr>
@endforeach
</table>
</div>