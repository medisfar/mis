<!-- resources/views/livewire/map-modal.blade.php -->

<div>
   @jon($locations)
    
    <div style="height:400px">
        <iframe src="{{$mapUrl}}" 
                style="width: 100%; height: 100%; border: none;">
        </iframe>
    </div>
    
</div>