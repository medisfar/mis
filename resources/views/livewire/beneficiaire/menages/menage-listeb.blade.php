
<div>

<a class="btn btn-sm btn-success" href="{{route('beneficiaire.menages.add')}}">Ajouter</a>
<br><br>

        <div class="table-responsive">
        <table  class="table table-bordered table-striped">
<tr>
	
	<th>Chef de menage</th>
<th></th></tr>
@foreach($menages as $item)
<tr>
	
	<td>{{$item->chef}}</td>
<td><a class="btn btn-sm btn-primary"  href="{{route('beneficiaire.menages.show',$item->id)}}">Voir</a>
</td>
</tr>
@endforeach
</table></div>

    
</div>