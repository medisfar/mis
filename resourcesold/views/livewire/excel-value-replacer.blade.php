<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Excel Value Replacer</h3>
        </div>
        
        <div class="card-body">
            @if(!$uploadId)
                <!-- File Upload Section -->
                <form wire:submit.prevent="processFile">
                    <div class="form-group">
                        <label for="file">Select Excel File</label>
                        <input type="file" wire:model="file" class="form-control-file" id="file">
                        @error('file') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    
                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                        <span wire:loading>Processing...</span>
                        <span wire:loading.remove>Upload & Process</span>
                    </button>
                </form>
            @else
                <!-- Column Selection -->
                <div class="form-group">
                    <label>Select Column to Modify</label>
                    <select wire:model="selectedColumn" wire:change="loadColumnValues" class="form-control">
                        <option value="">-- Select Column --</option>
                        @foreach($columns as $column)
                            <option value="{{ $column }}">{{ $column }}</option>
                        @endforeach
                    </select>
                </div>
                
                @if($selectedColumn && count($uniqueValues) > 0)
                    <!-- Value Selection -->
                    <div class="form-group">
                        <label>Current Unique Values in "{{ $selectedColumn }}"</label>
                        <select wire:model="selectedValue" class="form-control">
                            <option value="">-- Select Value to Apply --</option>
                            @foreach($uniqueValues as $value)
                                <option value="{{ $value }}">{{ $value }}</option>
                            @endforeach
                        </select>
                        @error('selectedValue') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    
                    <button wire:click="replaceValues" class="btn btn-success">
                        Replace All Values with Selected
                    </button>
                @endif
                
                @if($isProcessed)
                    <div class="alert alert-success mt-3">
                        File processed successfully!
                        <a href="{{ $downloadLink }}" class="btn btn-primary ml-3">Download Modified File</a>
                    </div>
                @endif
            @endif
        </div>
        
        <div class="card-footer">
            <small>Status: {{ $uploadId ? 'File uploaded (not treated)' : 'No file uploaded' }}</small>
        </div>
    </div>
</div>
