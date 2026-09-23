<x-slot name="titre">Sites</x-slot>

              <x-slot name="stitre">@include('livewire.datacollect.menu')</x-slot>
<div>
<table  class="table table-bordered">
<tr>
	<th>Nom</th>
	<td>{{$site->nom}}</td>
</tr>
<tr>
	<th>Type_point_focal</th>
	<td>{{$site->type_point_focal}}</td>
</tr>
<tr>
	<th>Nom_point_focal</th>
	<td>{{$site->nom_point_focal}}</td>
</tr>
<tr>
	<th>Localite</th>
	<td>{{$site->localite->nom_localite??''}}</td>
	<td>{{$site->localite_id}}</td>
</tr>
<tr>
    <th>Actions</th>
    <td colspan="2">
        <a class="btn btn-sm btn-primary" href="{{route('datacollect.sites')}}">Liste</a>
        <a class="btn btn-sm btn-primary" href="{{route('datacollect.sites.edit',$site->id)}}"><i class="fas fa-edit"></i></a>
        <button class="btn btn-sm btn-danger" wire:click="destroySite({{$site->id}})"><i class="fas fa-trash"></i></button>
    </td>
</tr>
</table>


 <br><br>
    <table class="table table-bordered table-striped">
        <thead>
            <tr style="background: purple; color: white;">
                <th>Groupement</th>
                <th>Mère conseillère</th>
                <th>Nbre de membres</th>
            </tr>
        </thead>
        <tbody>
@foreach($site->groupements as $fy)
            <tr>
                <td>{{$fy->nom_groupe??''}}</td>
                <td>{{$fy->mere_conseillere??'Aucune'}}</td>
                <td>{{$fy->membres->count()}}</td>
            </tr>
@endforeach
        </tbody>
    </table>

</div>
