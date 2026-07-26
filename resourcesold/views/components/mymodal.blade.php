<div>
     <!-- Modal Structure -->
    <div class="modal fade @if($isOpen) show @endif"  id="m{{$mid}}" tabindex="-1" role="dialog" style="display: @if($isOpen) block @else none @endif;">
        <div class="modal-dialog {{ $modalWidth }}" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{$label}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    
                </div>
                <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
                    <p></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="$dispatch('closeModal')">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>