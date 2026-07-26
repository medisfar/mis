{{-- resources/views/components/m2-tabs.blade.php --}}
@props(['tabs' => [], 'activeTab' => null, 'type' => 'default'])

<div {{ $attributes->merge(['class' => 'm2-tabs ' . $type]) }}
     x-data="{ activeTab: '{{ $activeTab }}' }">
    
    {{-- Tab Headers --}}
    <div class="tabs-header">
        <ul class="nav nav-tabs" role="tablist">
            @foreach($tabs as $tab)
                <li class="nav-item" role="presentation">
                    <button 
                        class="nav-link {{ $isActive($tab['id']) ? 'active' : '' }}"
                        :class="{ 'active': activeTab === '{{ $tab['id'] }}' }"
                        @click="activeTab = '{{ $tab['id'] }}'"
                        type="button"
                        role="tab"
                        aria-controls="{{ $tab['id'] }}"
                        :aria-selected="activeTab === '{{ $tab['id'] }}' ? 'true' : 'false'"
                    >
                        @if($tab['icon'] ?? false)
                            <i class="{{ $tab['icon'] }}"></i>
                        @endif
                        {{ $tab['label'] }}
                    </button>
                </li>
            @endforeach
        </ul>
    </div>
    
    {{-- Tab Contents --}}
    <div class="tab-content mt-3">
        @foreach($tabs as $tab)
            <div 
                class="tab-pane fade {{ $isActive($tab['id']) ? 'show active' : '' }}"
                :class="{ 'show active': activeTab === '{{ $tab['id'] }}' }"
                id="{{ $tab['id'] }}"
                role="tabpanel"
                aria-labelledby="{{ $tab['id'] }}-tab"
                x-show="activeTab === '{{ $tab['id'] }}'"
            >
                {{-- Get content from child M2Tab components --}}
                @if(isset($tabContents[$tab['label']]))
                    {!! $tabContents[$tab['label']] !!}
                @else
                    {{-- Fallback: Render slot content if tabs prop not used --}}
                    @foreach((array) $slot as $content)
                        {{-- Content will be injected here by M2Tab components --}}
                    @endforeach
                @endif
            </div>
        @endforeach
        
        {{-- Dynamic tab contents from child components --}}
        
            {{ $slot }}
        
    </div>
</div>

@push('styles')
<style>
.m2-tabs .nav-tabs {
    border-bottom: 2px solid #dee2e6;
}

.m2-tabs .nav-link {
    border: none;
    color: #6c757d;
    padding: 0.75rem 1.5rem;
    margin-bottom: -2px;
}

.m2-tabs .nav-link.active {
    color: #0d6efd;
    border-bottom: 2px solid #0d6efd;
    background-color: transparent;
}

.m2-tabs .nav-link:hover:not(.active) {
    border-color: transparent;
    color: #495057;
}

.tab-content > .tab-pane {
    display: none;
}

.tab-content > .active {
    display: block;
}

.m2-tabs .nav-link i {
    margin-right: 0.5rem;
}
</style>
@endpush