<div class="card ">
    @if($cardHeader)
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs" role="tablist">
            @foreach($tabs as $key => $tab)
                <li class="nav-item" role="presentation">
                    <button
                        class="nav-link {{ $activeTab === $key ? 'active' : '' }}"
                        wire:click="switchTab('{{ $key }}')"
                        type="button"
                        role="tab"
                    >
                        @if(isset($tab['icon']))
                            <i class="{{ $tab['icon'] }} me-2"></i>
                        @endif
                        {{ $tab['label'] }}
                        
                        @if(isset($tab['badge']))
                            <span class="badge rounded-pill bg-{{ $tab['badgeType'] ?? 'primary' }} ms-2">
                                {{ $tab['badge']??'' }}
                            </span>
                        @endif
                    </button>
                </li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="card-body">
        <div class="tab-content">
            @foreach($tabs as $key => $tab)
                <div class="tab-pane fade {{ $activeTab === $key ? 'show active' : '' }}">
                    @if(isset($tab['content']))
                        {!! $tab['content'] !!}
                    @elseif(isset($tab['component']))
                        @livewire($tab['component'], isset($tab['params']) ? $tab['params'] : [])
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>