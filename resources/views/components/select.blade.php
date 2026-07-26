@props(['nc','label','fd','options','disabled'=>false])
<div class="form-group  col-md-{{$nc??''}}">
    <label for="{{$fd??''}}">{{$label??''}}</label>
    
    <select wire:model.live="{{$fd??''}}"
     @if($disabled) disabled="true" @endif
       class="form-control">
        @if(reset($options)!='')
        <option value=""></option>
        @endif
        @foreach($options as $k=>$v)
        <option value="{{$k}}">{{$v}}</option>
        @endforeach
    </select>
</div>