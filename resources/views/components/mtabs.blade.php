<div class="nav nav-tabs" id="myTab" role="tablist">
    @foreach($tabs as $index => $tab)
       <a class="nav-item nav-link {{ $tab['id'] === $activeTab ? 'active' : '' }} {{ isset($tab['color']) ? $colorClasses[$tab['color']] ?? '' : '' }}"
           id="{{ $tab['id'] }}-tab" 
           data-toggle="tab" 
           href="#{{ $tab['id'] }}" 
           role="tab" 
           aria-controls="{{ $tab['id'] }}" 
           aria-selected="{{ $tab['id'] === $activeTab ? 'true' : 'false' }}">
             @if(isset($tab['icon']))
       <i class="{{ $tab['icon'] }}"></i>
   @endif
           {!! $tab['label'] !!} 
        </a>
    @endforeach
</div>
<div class="tab-content" id="myTabContent">
    @foreach($tabs as $index => $tab)
        <div class="tab-pane fade {{ $tab['id'] === $activeTab ? 'show active' : '' }}" 
             id="{{ $tab['id'] }}" 
             role="tabpanel" 
             aria-labelledby="{{ $tab['id'] }}-tab">
            @if($tab['content']=='')
             
               @php
                    $componentParams = ['key' => $tab['component'] . now()];
                    if (isset($tab['params'])) {
                        $componentParams = array_merge($componentParams, $tab['params']);
                    }
                 @endphp
                @livewire($tab['component'], $componentParams)
             @else
                @include($tab['content']) 
             @endif
        </div>
    @endforeach
</div>
