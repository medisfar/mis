@push('mescss')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
<style>
    .tree-indent-1 { padding-left: 2rem !important; }
    .tree-indent-2 { padding-left: 3.5rem !important; }
    .tree-indent-3 { padding-left: 5rem !important; }
    .tree-indent-4 { padding-left: 6.5rem !important; }
    
    .tree-line-left { 
        border-left: 2px dashed #dee2e6; 
        margin-left: 1rem;
    }
    
    .tree-node {
        transition: all 0.2s ease;
        cursor: pointer;
        user-select: none;
    }
    
    .tree-node:hover {
        background-color: rgba(0, 123, 255, 0.05);
    }
    
    .tree-node.active {
        background-color: rgba(0, 123, 255, 0.1);
        border-left: 3px solid #0d6efd;
    }
    
    .badge-category { background-color: #d1ecf1; color: #0c5460; }
    .badge-product { background-color: #d4edda; color: #155724; }
    .badge-service { background-color: #f8d7da; color: #721c24; }
    
    .status-active { background-color: #d1e7dd; color: #0f5132; }
    .status-inactive { background-color: #f8d7da; color: #842029; }
    .status-pending { background-color: #fff3cd; color: #664d03; }
    
    .card-tree {
        border: 1px solid rgba(0,0,0,.125);
        margin-bottom: 0.5rem;
    }
    
    .card-tree-child {
        border-left: 3px solid #6c757d;
        margin-left: 1.5rem;
    }
    
    .table-tree > tbody > tr:hover {
        background-color: rgba(0,0,0,.02);
    }
    
    .bg-tree-light { background-color: #f8f9fa; }
    
    .tree-toggle {
        width: 24px;
        height: 24px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        border-radius: 50%;
        transition: transform 0.2s ease;
        margin-right: 8px;
    }
    
    .tree-toggle:hover {
        background-color: rgba(0,0,0,.1);
    }
    
    .tree-toggle.collapsed .bi-chevron-down {
        transform: rotate(-90deg);
        transition: transform 0.2s ease;
    }
    
    .tree-children {
        transition: max-height 0.3s ease-out;
        overflow: hidden;
    }
    
    .tree-children.collapsed {
        max-height: 0;
        opacity: 0;
    }
    
    .tree-children.expanded {
        max-height: 1000px;
        opacity: 1;
    }
    
    .tree-item {
        display: flex;
        align-items: center;
        min-height: 44px;
    }
    
    .fade-in {
        animation: fadeIn 0.3s ease-in;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .detail-tab {
        min-height: 300px;
    }
    
    .value-highlight {
        font-weight: 600;
        color: #198754;
    }
    
    /* Collapse indicators */
    .collapse-indicator {
        transition: transform 0.2s ease;
    }
    
    .collapsed .collapse-indicator {
        transform: rotate(-90deg);
    }
</style>
@endpush

@push('messcripts')
<script>
    // Collapse/expand functionality for tree nodes
    document.addEventListener('DOMContentLoaded', function() {
        // Add toggle icons to parent nodes
        document.querySelectorAll('.tree-node[data-has-children="true"]').forEach(node => {
            // Create toggle button if not exists
            if (!node.querySelector('.tree-toggle')) {
                const toggleBtn = document.createElement('span');
                toggleBtn.className = 'tree-toggle collapsed';
                toggleBtn.innerHTML = '<i class="bi bi-chevron-down collapse-indicator"></i>';
                node.querySelector('.tree-item-content').prepend(toggleBtn);
                
                // Add click event to toggle button
                toggleBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const childrenId = node.getAttribute('data-children-id');
                    if (childrenId) {
                        const children = document.getElementById(childrenId);
                        if (children) {
                            if (children.classList.contains('collapsed')) {
                                // Expand
                                children.classList.remove('collapsed');
                                children.classList.add('expanded');
                                toggleBtn.classList.remove('collapsed');
                            } else {
                                // Collapse
                                children.classList.remove('expanded');
                                children.classList.add('collapsed');
                                toggleBtn.classList.add('collapsed');
                            }
                        }
                    }
                });
            }
        });

        // Tree node click handling for selection
        document.querySelectorAll('.tree-node').forEach(node => {
            node.addEventListener('click', function(e) {
                // Don't trigger if clicking on toggle button
                if (!e.target.closest('.tree-toggle')) {
                    // Remove active class from all nodes
                    document.querySelectorAll('.tree-node').forEach(n => {
                        n.classList.remove('active');
                    });
                    // Add active class to clicked node
                    this.classList.add('active');
                    
                    // You can add your own logic here to load content
                    const nodeId = this.getAttribute('data-node-id');
                    console.log('Selected node:', nodeId);
                }
            });
        });

        // Initialize all children as collapsed
        document.querySelectorAll('.tree-children').forEach(children => {
            children.classList.add('collapsed');
        });
    });
</script>
@endpush
<x-slot name="titre">Three view</x-slot>
<div>
<div class="row">

  @include("livewire.partials.tree-left")
  @include("livewire.partials.tree-right")
</div>
</div>