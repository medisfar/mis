@props(['nc','label','fd','type'=>'text'])
<div class="form-group  col-md-{{$nc??''}}">
    <label for="{{$fd??''}}">{{$label??''}}</label>

    <input  type="file" wire:model.lazy="{{$fd??''}}" class="form-control">
</div>