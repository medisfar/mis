<div>
<select wire:model="pid" wire:change="select($event.target.value)">
<option value="">--- choisir projet ---</option>
@foreach($prs as $item)
<option value="{{$item->id}}">{{$item->libelle}}</option>
@endforeach
</select>
</div>
