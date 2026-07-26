<div>
<select wire:model.live="pid" wire:change="select">   
<option>--- choisir projet ---</option>
@foreach($prs as $item)
<option value="{{$item->id}}">{{$item->libelle}}</option>
@endforeach
</select>
</div>
