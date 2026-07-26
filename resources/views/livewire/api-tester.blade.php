<div class="container-fluid py-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-plug me-2"></i>API Endpoint Tester</h5>
        </div>
        <div class="card-body">
            <!-- Error Alert -->
            @if($error)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $error }}
                    <button type="button" class="btn-close" wire:click="$set('error', null)"></button>
                </div>
            @endif

            <!-- Method and URL Input -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <label class="form-label">HTTP Method</label>
                    <select class="form-select" wire:model="selectedMethod">
                        @foreach($methods as $method)
                            <option value="{{ $method }}" 
                                    class="method-{{ strtolower($method) }}">
                                {{ $method }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-9">
                    <label class="form-label">Endpoint URL</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-link"></i>
                        </span>
                        <input type="text" 
                               class="form-control @error('url') is-invalid @enderror" 
                               wire:model="url" 
                               placeholder="https://api.example.com/endpoint">
                        @error('url') 
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Parameters Section -->
            <div class="card mb-4">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        <i class="fas fa-list me-2"></i>Parameters
                        <button type="button" 
                                class="btn btn-sm btn-outline-primary float-end"
                                wire:click="addParam">
                            <i class="fas fa-plus"></i> Add
                        </button>
                    </h6>
                </div>
                <div class="card-body">
                    @foreach($params as $index => $param)
                        <div class="row mb-2" wire:key="param-{{ $index }}">
                            <div class="col-md-5">
                                <input type="text" 
                                       class="form-control" 
                                       wire:model="params.{{ $index }}.key"
                                       placeholder="Parameter Key">
                            </div>
                            <div class="col-md-5">
                                <input type="text" 
                                       class="form-control" 
                                       wire:model="params.{{ $index }}.value"
                                       placeholder="Parameter Value">
                            </div>
                            <div class="col-md-2">
                                @if($index > 0)
                                    <button type="button" 
                                            class="btn btn-danger w-100"
                                            wire:click="removeParam({{ $index }})">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Headers Section -->
            <div class="card mb-4">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        <i class="fas fa-heading me-2"></i>Headers
                        <button type="button" 
                                class="btn btn-sm btn-outline-primary float-end"
                                wire:click="addHeader">
                            <i class="fas fa-plus"></i> Add
                        </button>
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Content-Type</label>
                            <select class="form-select" wire:model="contentType">
                                <option value="application/json">application/json</option>
                                <option value="application/x-www-form-urlencoded">application/x-www-form-urlencoded</option>
                                <option value="multipart/form-data">multipart/form-data</option>
                                <option value="text/plain">text/plain</option>
                            </select>
                        </div>
                    </div>
                    
                    @foreach($headers as $index => $header)
                        <div class="row mb-2" wire:key="header-{{ $index }}">
                            <div class="col-md-5">
                                <input type="text" 
                                       class="form-control" 
                                       wire:model="headers.{{ $index }}.key"
                                       placeholder="Header Key (e.g., Authorization)">
                            </div>
                            <div class="col-md-5">
                                <input type="text" 
                                       class="form-control" 
                                       wire:model="headers.{{ $index }}.value"
                                       placeholder="Header Value">
                            </div>
                            <div class="col-md-2">
                                @if($index > 0)
                                    <button type="button" 
                                            class="btn btn-danger w-100"
                                            wire:click="removeHeader({{ $index }})">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="d-flex justify-content-between mb-4">
                <div>
                    <button type="button" 
                            class="btn btn-success"
                            wire:click="testApi"
                            wire:loading.attr="disabled"
                            wire:target="testApi">
                        <span wire:loading.remove wire:target="testApi">
                            <i class="fas fa-play me-2"></i>Test Endpoint
                        </span>
                        <span wire:loading wire:target="testApi">
                            <span class="spinner-border spinner-border-sm me-2"></span>
                            Testing...
                        </span>
                    </button>
                    
                    <button type="button" 
                            class="btn btn-outline-secondary ms-2"
                            wire:click="resetTest">
                        <i class="fas fa-redo me-2"></i>Clear Results
                    </button>
                </div>
                
                <button type="button" 
                        class="btn btn-outline-danger"
                        wire:click="clearAll">
                    <i class="fas fa-broom me-2"></i>Clear All
                </button>
            </div>

            <!-- Response Section -->
            @if($response || $status)
                <div class="card mt-4">
                    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">
                            <i class="fas fa-reply me-2"></i>Response
                            @if($time)
                                <span class="badge bg-info ms-2">{{ $time }} ms</span>
                            @endif
                        </h6>
                        <div class="form-check form-switch">
                            <input class="form-check-input" 
                                   type="checkbox" 
                                   id="showRaw" 
                                   wire:model="showRaw">
                            <label class="form-check-label text-white" for="showRaw">
                                Raw Response
                            </label>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Status Code -->
                        <div class="mb-3">
                            <span class="badge 
                                @if($status >= 200 && $status < 300) bg-success
                                @elseif($status >= 300 && $status < 400) bg-info
                                @elseif($status >= 400 && $status < 500) bg-warning
                                @else bg-danger @endif fs-6">
                                Status: {{ $status }}
                            </span>
                        </div>

                        <!-- Response Body -->
                        @if($showRaw)
                            <pre class="bg-light p-3 rounded" style="max-height: 500px; overflow-y: auto;">
                                <code>{{ is_string($response) ? $response : json_encode($response, JSON_PRETTY_PRINT) }}</code>
                            </pre>
                        @elseif(is_array($response))
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Key</th>
                                            <th>Value</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($response as $key => $value)
                                            <tr>
                                                <td class="fw-bold">{{ $key }}</td>
                                                <td>
                                                    @if(is_array($value))
                                                        <pre class="mb-0">{{ json_encode($value, JSON_PRETTY_PRINT) }}</pre>
                                                    @elseif(is_bool($value))
                                                        {{ $value ? 'true' : 'false' }}
                                                    @else
                                                        {{ $value }}
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-info">
                                {{ $response }}
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Loading Overlay -->
    @if($loading)
        <div class="position-fixed top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center bg-dark bg-opacity-50" style="z-index: 1050;">
            <div class="text-center text-white">
                <div class="spinner-border text-primary mb-3" style="width: 3rem; height: 3rem;" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <h4>Testing API Endpoint...</h4>
                <p>Please wait while we send the request</p>
            </div>
        </div>
    @endif
</div>