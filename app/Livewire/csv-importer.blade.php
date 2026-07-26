<div class="card csv-importer">
    <div class="card-header bg-white">
        <h5 class="card-title mb-0">
            <i class="fas fa-file-import me-2"></i>CSV Import
        </h5>
    </div>
    
    <div class="card-body">
        <!-- File Upload -->
        <div class="mb-4">
            <label class="form-label fw-semibold">Upload CSV File</label>
            
            <input type="file" wire:model="file" 
                   class="form-control" 
                   accept=".csv,.txt" />
            
            <div class="form-text">
                Supported formats: CSV, TXT. Maximum file size: 10MB
            </div>
            
            @error('file')
                <div class="alert alert-danger mt-2 py-2" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                </div>
            @enderror
            
            @if($file && empty($errors))
                <div class="alert alert-success mt-2 py-2" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    File ready for import: <strong>{{ $file->getClientOriginalName() }}</strong>
                </div>
            @endif
        </div>

        <!-- Sample Data Preview -->
        @if(!empty($sampleData))
        <div class="mb-4">
            <h6 class="fw-semibold mb-3">
                <i class="fas fa-table me-2"></i>Data Preview (First 5 rows)
            </h6>
            <div class="table-responsive">
                <table class="table table-sm table-bordered table-striped">
                    <thead class="table-light">
                        <tr>
                            @foreach(array_keys($sampleData[0] ?? []) as $header)
                                <th class="text-nowrap">{{ $header }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sampleData as $index => $row)
                            <tr>
                                @foreach($row as $value)
                                    <td class="text-nowrap" style="max-width: 200px;">
                                        <span class="d-inline-block text-truncate" style="max-width: 200px;">
                                            {{ $value }}
                                        </span>
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="form-text text-end">
                Showing first {{ count($sampleData) }} rows
            </div>
        </div>
        @endif

        <!-- Import Progress -->
        @if($importing)
        <div class="mb-4">
            <div class="card bg-light border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="card-title mb-0 text-primary">
                            <i class="fas fa-sync-alt fa-spin me-2"></i>Importing Data...
                        </h6>
                        <span class="badge bg-primary fs-6">{{ $progress }}%</span>
                    </div>
                    
                    <div class="progress mb-3" style="height: 8px;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" 
                             role="progressbar" 
                             style="width: {{ $progress }}%"
                             aria-valuenow="{{ $progress }}" 
                             aria-valuemin="0" 
                             aria-valuemax="100">
                        </div>
                    </div>
                    
                    <div class="row text-center">
                        <div class="col">
                            <small class="text-muted">Total Rows</small>
                            <div class="fw-bold text-primary">{{ $totalRows }}</div>
                        </div>
                        <div class="col">
                            <small class="text-muted">Processed</small>
                            <div class="fw-bold text-success">{{ $processedRows }}</div>
                        </div>
                        <div class="col">
                            <small class="text-muted">Remaining</small>
                            <div class="fw-bold text-warning">{{ $totalRows - $processedRows }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Success Message -->
        @if($imported && !$hasErrors)
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <div class="d-flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-check-circle fa-lg me-3"></i>
                </div>
                <div class="flex-grow-1">
                    <h5 class="alert-heading">Import Completed Successfully!</h5>
                    <p class="mb-0">
                        <strong>{{ $processedRows }}</strong> rows have been imported successfully.
                    </p>
                    <p class="mb-0 mt-1">
                        <small class="text-muted">
                            <i class="fas fa-clock me-1"></i>
                            Completed at {{ now()->format('M j, Y g:i A') }}
                        </small>
                    </p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        @endif

        <!-- Action Buttons -->
        <div class="d-flex gap-2 flex-wrap">
            @if(!$importing && !$imported && $file)
                <button wire:click="importCsv" 
                        wire:loading.attr="disabled"
                        wire:target="importCsv"
                        class="btn btn-success btn-lg px-4">
                    <span wire:loading.remove wire:target="importCsv">
                        <i class="fas fa-play me-2"></i>Start Import
                    </span>
                    <span wire:loading wire:target="importCsv">
                        <span class="spinner-border spinner-border-sm me-2" role="status"></span>
                        Processing...
                    </span>
                </button>
            @endif

            @if($file && !$importing && !$imported)
                <button wire:click="resetImporter" 
                        class="btn btn-outline-secondary">
                    <i class="fas fa-times me-2"></i>Cancel
                </button>
            @endif

            @if($imported || $hasErrors)
                <button wire:click="resetImporter" 
                        class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Import Another File
                </button>
            @endif

            @if(!$file)
                <button type="button" class="btn btn-outline-info" 
                        data-bs-toggle="modal" data-bs-target="#helpModal">
                    <i class="fas fa-question-circle me-2"></i>Help
                </button>
            @endif
        </div>

        <!-- Errors -->
        @if($hasErrors)
        <div class="alert alert-danger mt-4" role="alert">
            <div class="d-flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-triangle fa-lg me-3"></i>
                </div>
                <div class="flex-grow-1">
                    <h5 class="alert-heading">Import Completed with Errors</h5>
                    <p class="mb-2">The import process finished but encountered some issues:</p>
                    
                    <div class="mt-3">
                        @foreach($errors as $error)
                            <div class="border-start border-3 border-danger ps-3 mb-2">
                                <div class="text-danger fw-semibold">{{ $error }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

    <!-- Help Modal -->
    <div class="modal fade" id="helpModal" tabindex="-1" aria-labelledby="helpModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="helpModalLabel">
                        <i class="fas fa-question-circle me-2"></i>CSV Import Help
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>File Requirements:</h6>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-check text-success me-2"></i>File format: CSV or TXT</li>
                                <li><i class="fas fa-check text-success me-2"></i>Maximum size: 10MB</li>
                                <li><i class="fas fa-check text-success me-2"></i>First row should be headers</li>
                                <li><i class="fas fa-check text-success me-2"></i>UTF-8 encoding recommended</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h6>Tips:</h6>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-lightbulb text-warning me-2"></i>Preview your data before importing</li>
                                <li><i class="fas fa-lightbulb text-warning me-2"></i>Ensure column headers match expected format</li>
                                <li><i class="fas fa-lightbulb text-warning me-2"></i>Large files may take several minutes</li>
                                <li><i class="fas fa-lightbulb text-warning me-2"></i>Don't close the browser during import</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <h6>Expected Columns:</h6>
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>Column</th>
                                        <th>Required</th>
                                        <th>Format</th>
                                        <th>Example</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Dynamic columns based on validation rules -->
                                    @foreach($validationRules as $column => $rules)
                                    <tr>
                                        <td><code>{{ $column }}</code></td>
                                        <td>
                                            @if(str_contains($rules, 'required'))
                                                <span class="badge bg-danger">Required</span>
                                            @else
                                                <span class="badge bg-secondary">Optional</span>
                                            @endif
                                        </td>
                                        <td>
                                            <small class="text-muted">
                                                @php
                                                    $ruleDescriptions = [];
                                                    if (str_contains($rules, 'email')) $ruleDescriptions[] = 'Email';
                                                    if (str_contains($rules, 'numeric')) $ruleDescriptions[] = 'Number';
                                                    if (str_contains($rules, 'date')) $ruleDescriptions[] = 'Date';
                                                    if (str_contains($rules, 'string')) $ruleDescriptions[] = 'Text';
                                                    echo implode(', ', $ruleDescriptions);
                                                @endphp
                                            </small>
                                        </td>
                                        <td>
                                            <small>
                                                @if(str_contains($rules, 'email'))
                                                    user@example.com
                                                @elseif(str_contains($rules, 'date'))
                                                    YYYY-MM-DD
                                                @else
                                                    Sample data
                                                @endif
                                            </small>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="/templates/import-template.csv" class="btn btn-outline-primary">
                        <i class="fas fa-download me-2"></i>Download Template
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Auto-refresh progress
    document.addEventListener('livewire:load', function () {
        setInterval(() => {
            if (@this.importing) {
                @this.call('getImportProgressProperty');
            }
        }, 2000);
    });

    // Bootstrap tooltips
    document.addEventListener('livewire:load', function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    });
</script>
@endpush