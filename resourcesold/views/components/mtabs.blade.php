<div class="nav nav-tabs" id="myTab" role="tablist">
    @foreach($tabs as $index => $tab)
        <a class="nav-item nav-link {{ $tab['id'] === $activeTab ? 'active' : '' }}" 
           id="{{ $tab['id'] }}-tab" 
           data-toggle="tab" 
           href="#{{ $tab['id'] }}" 
           role="tab" 
           aria-controls="{{ $tab['id'] }}" 
           aria-selected="{{ $tab['id'] === $activeTab ? 'true' : 'false' }}">
           {{ $tab['label'] }}
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
               @livewire($tab['component'],['key'=>$tab['component'].now()])
             @else
                @include($tab['content'],$tab['params']) 
             @endif
        </div>
    @endforeach
</div>
