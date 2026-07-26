<div>
    @if($show)
    <!-- Modal -->
    <div class="modal fade show d-block" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog {{ $size }} modal-dialog-scrollable">
            <div class="modal-content" style="display: flex; flex-direction: column; max-height: 90vh;">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $title }}</h5>
                    <button type="button" class="btn btn-sm btn-default" wire:click="hide" aria-label="Close">Close</button>
                </div>
                
                <div class="modal-body" style="style="overflow-y: auto; flex: 1;">
                    
                      
                    @if(isset($content['type']) && $content['type'] === 'component')
                    @livewire(
                        $content['name'],
                        $content['params'] ?? [],
                        key($content['key'] ?? 'default-key')
                    )
                @else
                    {!! $content !!}
                @endif
                </div>

                
            </div>
        </div>
    </div>

    <!-- Backdrop must be inside the root div -->
    <div class="modal-backdrop fade show"></div>
    @endif
</div>