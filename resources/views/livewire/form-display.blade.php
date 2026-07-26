<div>
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h2 class="card-title h4 mb-0">{{ $form->title }}</h2>
                    </div>
                    <div class="card-body">
                        @if (session()->has('message'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form wire:submit.prevent="submitForm">
                            @foreach($form->fields as $field)
                                <div class="mb-4">
                                    <label class="form-label">
                                        {{ $field['label'] }}
                                        @if($field['required']) 
                                            <span class="text-danger">*</span> 
                                        @endif
                                    </label>

                                    @if($field['type'] === 'text' || $field['type'] === 'email' || $field['type'] === 'number')
                                        <input type="{{ $field['type'] }}" 
                                               wire:model="submissions.{{ $field['name'] }}"
                                               @if($field['placeholder']) placeholder="{{ $field['placeholder'] }}" @endif
                                               class="form-control">
                                    @elseif($field['type'] === 'textarea')
                                        <textarea wire:model="submissions.{{ $field['name'] }}"
                                                  @if($field['placeholder']) placeholder="{{ $field['placeholder'] }}" @endif
                                                  rows="4"
                                                  class="form-control"></textarea>
                                    @elseif($field['type'] === 'select')
                                        <select wire:model="submissions.{{ $field['name'] }}"
                                                class="form-select">
                                            <option value="">Select an option</option>
                                            @foreach($field['options'] as $option)
                                                <option value="{{ $option }}">{{ $option }}</option>
                                            @endforeach
                                        </select>
                                    @elseif($field['type'] === 'checkbox')
                                        <div class="mt-2">
                                            @foreach($field['options'] as $option)
                                                <div class="form-check">
                                                    <input type="checkbox" 
                                                           wire:model="submissions.{{ $field['name'] }}"
                                                           value="{{ $option }}"
                                                           class="form-check-input"
                                                           id="checkbox-{{ $field['name'] }}-{{ $loop->index }}">
                                                    <label class="form-check-label" 
                                                           for="checkbox-{{ $field['name'] }}-{{ $loop->index }}">
                                                        {{ $option }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    @elseif($field['type'] === 'radio')
                                        <div class="mt-2">
                                            @foreach($field['options'] as $option)
                                                <div class="form-check">
                                                    <input type="radio" 
                                                           wire:model="submissions.{{ $field['name'] }}"
                                                           value="{{ $option }}"
                                                           class="form-check-input"
                                                           id="radio-{{ $field['name'] }}-{{ $loop->index }}">
                                                    <label class="form-check-label" 
                                                           for="radio-{{ $field['name'] }}-{{ $loop->index }}">
                                                        {{ $option }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    @elseif($field['type'] === 'date')
                                        <input type="date" 
                                               wire:model="submissions.{{ $field['name'] }}"
                                               class="form-control">
                                    @endif

                                    @error("submissions.{$field['name']}") 
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endforeach

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-send"></i> Submit Form
                                </button>
                            </div>
                        </form>

                        <!-- View Submissions -->
                        <div class="mt-5">
                            <button wire:click="showSubmissions"
                                    class="btn btn-outline-secondary">
                                <i class="bi bi-list"></i> 
                                {{ $showSubmissions ? 'Hide' : 'View' }} Submissions 
                                ({{ $this->submissions->count() }})
                            </button>

                            @if($showSubmissions)
                                <div class="mt-4">
                                    <h5 class="mb-3">Form Submissions</h5>
                                    
                                    @if($this->submissions->count() > 0)
                                        @foreach($this->submissions as $submission)
                                            <div class="card mb-3">
                                                <div class="card-header bg-light d-flex justify-content-between">
                                                    <small class="text-muted">
                                                        Submitted: {{ $submission->created_at->format('M j, Y g:i A') }}
                                                    </small>
                                                    <small class="text-muted">
                                                        IP: {{ $submission->ip_address }}
                                                    </small>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        @foreach($submission->data as $key => $value)
                                                            <div class="col-md-6 mb-2">
                                                                <strong>{{ ucfirst(str_replace('_', ' ', $key)) }}:</strong>
                                                                <span class="ms-2">
                                                                    {{ is_array($value) ? implode(', ', $value) : $value }}
                                                                </span>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="alert alert-info">
                                            No submissions yet.
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>