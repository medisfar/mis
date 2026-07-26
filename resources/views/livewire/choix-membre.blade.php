<div>
    {{-- Success is as dangerous as failure. --}}
  {{$ses_id}} 
  <div class="mb-3">
        <label for="session_select" class="form-label">Sélectionner une session:</label>
        <select 
            id="session_select" 
            class="form-select" 
            wire:model.live="ses_id"
        >
            <option value="">Choisir une session</option>
            @foreach(\App\Models\Psession::pluck('nom','id') as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </select>
<table  class="table table-bordered table-striped">
<tr>

	<th>Nom</th>

<th></th></tr>
@foreach($membres as $item)
<tr>

	<td>{{$item->nom}}</td>
<td>
    <a href="#" wire:click="add" >Ajouter</a>
</td>
</tr>
@endforeach
</table></div>

</div>
