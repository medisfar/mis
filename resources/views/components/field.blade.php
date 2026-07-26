@props(['nc','label','fd','type'=>'text'])
<div class="form-group  col-md-{{$nc??''}}">
    <label for="{{$fd??''}}">{{$label??''}}</label>

    <input @if(\Str::startsWith($fd,'date_')) type="date" @endif wire:model.lazy="{{$fd??''}}" class="form-control">
</div>