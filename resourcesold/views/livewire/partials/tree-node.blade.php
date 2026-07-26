@props(['node', 'level', 'selectedNodeId', 'expandedNodes'])

@php
    $isSelected = isset($selectedNodeId) && $selectedNodeId === ($node['id'] ?? null);
    $isExpanded = in_array($node['id'] ?? '', $expandedNodes ?? []);
    $hasChildren = !empty($node['children'] ?? []);
    $level=0;
@endphp

<div 
    class="tree-node" 
    data-node-id="{{ $node['id'] ?? '' }}"
    data-level="{{ $level }}"
    data-has-children="{{ $hasChildren ? 'true' : 'false' }}"
    role="treeitem"
    aria-level="{{ $level }}"
    aria-selected="{{ $isSelected ? 'true' : 'false' }}"
>
    <div 
        class="tree-item {{ $isSelected ? 'selected' : '' }}"
        wire:click="selectNode('{{ $node['id'] ?? '' }}')"
        style="padding-left: {{ $level * 20 }}px; cursor: pointer;"
        wire:key="node-{{ $node['id'] ?? '' }}"
    >
        @if($hasChildren)
            <button 
                class="tree-toggle btn btn-sm p-0 me-1 {{ !$isExpanded ? 'collapsed' : '' }}" 
                wire:click.stop="toggleNode('{{ $node['id'] ?? '' }}')"
                aria-expanded="{{ $isExpanded ? 'true' : 'false' }}"
                style="width: 24px; height: 24px; border: none; background: transparent;"
                type="button"
            >
                <i class="bi bi-chevron-down"></i>
            </button>
        @else
            <span class="tree-toggle" style="visibility: hidden; width: 24px; height: 24px; display: inline-block;"></span>
        @endif
        
        <div class="tree-item-content d-flex align-items-center flex-grow-1">
            @php
                $iconClass = 'bi-folder-fill';
                $typeClass = 'category';
                
                if(isset($node['type'])) {
                    if($node['type'] == 'category') {
                        $iconClass = 'bi-folder-fill';
                        $typeClass = 'category';
                    } elseif($node['type'] == 'product') {
                        $iconClass = 'bi-box-seam';
                        $typeClass = 'product';
                    } elseif($node['type'] == 'service') {
                        $iconClass = 'bi-gear';
                        $typeClass = 'service';
                    } elseif($node['type'] == 'file') {
                        $iconClass = 'bi-file-earmark';
                        $typeClass = 'file';
                    }
                }
            @endphp
            
            <i class="type-icon {{ $typeClass }} bi {{ $iconClass }} me-2"></i>
            
            <span class="node-name flex-grow-1">{{ $node['name'] ?? 'Unnamed' }}</span>
            
            @if(isset($node['type']))
                <span class="badge ms-2 
                    @if($node['type'] == 'category') bg-warning text-dark
                    @elseif($node['type'] == 'product') bg-primary
                    @elseif($node['type'] == 'service') bg-success
                    @else bg-secondary
                    @endif">
                    {{ ucfirst($node['type']) }}
                </span>
            @endif
            
            @if(isset($node['status']))
                @php
                    $statusColor = match($node['status']) {
                        'active' => 'success',
                        'inactive' => 'secondary',
                        'pending' => 'warning',
                        'archived' => 'danger',
                        default => 'info'
                    };
                @endphp
                <span class="status-indicator ms-2">
                    <span class="badge bg-{{ $statusColor }}">{{ $node['status'] }}</span>
                </span>
            @endif
        </div>
    </div>
    
    @if($hasChildren && $isExpanded)
        <div 
            id="children-{{ $node['id'] }}" 
            class="tree-children"
            role="group"
        >
            @foreach($node['children'] as $child)
                @include('livewire.partials.tree-node', [
                    'node' => $child,
                    'level' => $level + 1,
                    'selectedNodeId' => $selectedNodeId,
                    'expandedNodes' => $expandedNodes
                ])
            @endforeach
        </div>
    @endif
</div>