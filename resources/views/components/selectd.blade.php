@props(['nc', 'label', 'fd', 'options', 'dependsOn'])

<div class="form-group col-md-{{$nc??''}}">
    @if($label ?? false)
        <label for="{{$fd}}">{{$label}}</label>
    @endif
    
    <select 
        wire:model.live="{{$fd}}" 
        class="form-control"
        @if($dependsOn) 
            wire:loading.attr="disabled"
            wire:target="{{ $dependsOn }}"
        @endif
       @if($emitEvent)
            wire:change="$dispatch('{{ $emitEvent }}', {'value':$event.target.value})"
        @endif
        >
        @if(!empty($options) && reset($options) != '')
            <option value=""></option>
        @endif
        
        @foreach($options as $k => $v)
            <option value="{{$k}}">{{$v}}</option>
        @endforeach
    </select>
</div>