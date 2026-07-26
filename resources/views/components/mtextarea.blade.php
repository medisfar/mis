@props(['nc','label','fd'])
<div class="form-group  col-md-{{$nc??''}}">
    <label for="{{$fd??''}}">{{$label??''}}</label>
    
    <textarea wire:model.live="{{$fd??''}}"
     
       class="form-control">
        
    </textarea>
</div>