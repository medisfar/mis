<div class="flex h-screen">
    <!-- Left panel: tree -->
    <div class="w-1/3 border-r overflow-auto p-4">
        <h2 class="font-bold mb-4">Categories</h2>
        <ul class="space-y-1">
            @foreach($nodes as $node)
                @include('livewire.partials.tree-node', ['node' => $node])
            @endforeach
        </ul>
    </div>

    <!-- Right panel: details -->
    <div class="w-2/3 p-4">
        @if($selectedNode)
            <h2 class="text-xl font-bold mb-4">{{ $selectedNode['name'] }}</h2>
            <dl class="grid grid-cols-3 gap-2">
                <dt class="font-semibold">ID</dt>
                <dd class="col-span-2">{{ $selectedNode['id'] }}</dd>

                @if(isset($selectedNode['children']) && count($selectedNode['children']))
                    <dt class="font-semibold">Children</dt>
                    <dd class="col-span-2">{{ count($selectedNode['children']) }} sub-items</dd>
                @endif
            </dl>
        @else
            <p class="text-gray-500">Select a category to see details</p>
        @endif
    </div>
</div>