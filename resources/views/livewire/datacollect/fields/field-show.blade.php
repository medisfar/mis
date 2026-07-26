<x-slot name="titre">Fields</x-slot>

              <x-slot name="stitre">@include('livewire.datacollect.menu')</x-slot>
<div>
<table  class="table table-bordered">
<tr>
	<th>Nom</th>
	<td>{{$field->nom}}</td>
</tr>
<tr>
	<th>Psession</th>
	<td>{{$field->psession->nom??''}}</td>
	<td>{{$field->psession_id}}</td>
</tr>
<tr>
	<th>Row</th>
	<td>{{$field->row}}</td>
</tr>
<tr>
	<th>Col</th>
	<td>{{$field->col}}</td>
</tr>
<tr>
	<th>Options</th>
	<td>{{$field->options}}</td>
</tr>
</table>
<a class="btn btn-sm btn-primary" href="{{route('datacollect.fields')}}">Liste</a>
<a class="btn btn-sm btn-primary" href="{{route('datacollect.fields.edit',$field->id)}}"><i class="fas fa-edit"></i></button>
 <button  class="btn btn-sm btn-danger" wire:click="destroyField({{$field->id}})"><i class="fas fa-trash"></i></button>  
</div>