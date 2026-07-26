<div>
    <div class="table-responsive">
<table  class="table table-bordered table-striped">
<tr>
    <th>Code</th>
    <th>Libelle</th>
    
    
    <th>Budget</th>
    <th>Date_debut</th>
    <th>Date_fin</th>
    <th>Statut</th>
    
<th></th></tr>
@foreach($prs as $item)
<tr>
    <td>{{$item->code}}</td>
    <td>{{$item->libelle}}</td>
    
    <td>{{$item->budget}}</td>
    <td>{{$item->date_debut}}</td>
    <td>{{$item->date_fin}}</td>
    <td>{{$item->lestatut}}</td>
    
<td><a class="btn btn-sm btn-success"
wire:click="select({{$item->id}})">Selectioner</a>


</td>

</tr>
@endforeach
</table></div>
{{$prs->links()}}
    
</div>
</div>
