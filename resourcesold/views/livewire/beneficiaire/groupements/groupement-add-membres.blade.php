<x-slot name="titre">Groupement {{$groupement->nom_groupe}} Localite {{$groupement->activite->localite->nom_localite??''}}</x-slot>

              <x-slot name="stitre">Ajouter des membres</x-slot>
<div>
     <table  class="table table-bordered table-striped">
<tr><th></th>
   <th>Menage</th>
    <th>Nom</th>
    <th>Date naissance</th>
    <th>Enceinte</th>
    
<th></th></tr>

@if($localite)
  @foreach($localite->menages as $menage)
    @foreach($menage->membres as $item)
      <tr>
        <td><input type="checkbox" wire:model="sps.{{ $item->id }}"></td>
        <td>{{ $item->menage_id }}</td>
        <td>{{ $item->nom }}</td>
        <td>{{ $item->date_naissance }}</td>
        <td>{{ $item->enceinte ? 'Yes' : 'No' }}</td>
      </tr>
    @endforeach
  @endforeach
@else
  <tr>
    <td colspan="5">No locality found.</td>
  </tr>
@endif
</table>
<button  class="btn btn-sm btn-info" wire:click="save({{$groupement->id}})">Select</button> 
</div>