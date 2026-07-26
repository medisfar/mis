<div class="container-fluid py-4" wire:ignore.self>
    <a href="{{route('datacollect.sessions.tabs')}}">retour</a>
    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Error Message -->
    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Top Form Section - Add/Edit Field -->
    <div class="card shadow-sm mb-4" id="top-form">
        <div class="card-header bg-primary text-white">
            <h2 class="h4 mb-0">
                <i class="fas fa-plus-circle me-2"></i>
                {{ $editingIndex === null ? 'Add New Field' : 'Edit Field' }}
            </h2>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="{{ $editingIndex === null ? 'addField' : 'updateField' }}">
                <div class="row g-3">
                    <!-- Field Label -->
                    <div class="col-md-6">
                        <label class="form-label">Label <span class="text-danger">*</span></label>
                        <input type="text" 
                               wire:model="currentField.label" 
                               class="form-control @error('currentField.label') is-invalid @enderror"
                               placeholder="Enter field label">
                        @error('currentField.label') 
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Field Name -->
                    <div class="col-md-6">
                        <label class="form-label">Field Name <span class="text-danger">*</span></label>
                        <input type="text" 
                               wire:model="currentField.name" 
                               class="form-control @error('currentField.name') is-invalid @enderror"
                               placeholder="Enter field name">
                        @error('currentField.name') 
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Data Type -->
                    <div class="col-md-6">
                        <label class="form-label">Data Type</label>
                        <select wire:model="currentField.data_type" 
                                class="form-select">
                            @foreach($dataTypes as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Field Type -->
                    <div class="col-md-6">
                        <label class="form-label">Field Type</label>
                        <select wire:model.live="currentField.field_type" 
                                class="form-select">
                            @foreach($fieldTypes as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Required -->
                    <div class="col-md-6">
                        <div class="form-check">
                            <input type="checkbox" 
                                   wire:model="currentField.required" 
                                   id="required-current"
                                   class="form-check-input">
                            <label for="required-current" class="form-check-label">Required Field</label>
                        </div>
                    </div>

                    <!-- Placeholder -->
                    <div class="col-md-6">
                        <label class="form-label">Placeholder</label>
                        <input type="text" 
                               wire:model="currentField.placeholder" 
                               class="form-control"
                               placeholder="Optional placeholder text">
                    </div>
                </div>

                <!-- Options Management for Select/Radio/Checkbox -->
                @if(in_array($currentField['field_type'], ['select', 'radio', 'checkbox']))
                    <div class="row mt-4">
                        <div class="col-12">
                            <label class="form-label fw-bold">
                                <i class="fas fa-list me-2"></i>Options Management
                                @if(in_array($currentField['field_type'], ['select', 'radio']))
                                    <span class="text-danger">*</span>
                                @endif
                            </label>
                            
                            <!-- Instructions for different field types -->
                            @if($currentField['field_type'] === 'checkbox')
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle me-2"></i>
                                    For checkboxes: Add options to create a checkbox group. Leave empty for a single checkbox.
                                </div>
                            @endif
                            
                            <!-- Add Option Input -->
                            <div class="input-group mb-3">
                                <input type="text" 
                                       wire:model.live="newOption" 
                                       wire:keydown.enter.prevent="addOption"
                                       class="form-control" 
                                       placeholder="Enter a new option">
                                <button type="button" 
                                        wire:click="addOption"
                                        class="btn btn-success"
                                        {{ empty(trim($newOption)) ? 'disabled' : '' }}>
                                    <i class="fas fa-plus me-1"></i>Add Option
                                </button>
                            </div>
                            <div class="form-text mb-3">Press Enter or click "Add Option" to add options to the list</div>

                            <!-- Options List -->
                            @if(count($currentField['options']) > 0)
                                <div class="card">
                                    <div class="card-header bg-light">
                                        <h6 class="mb-0">Options List ({{ count($currentField['options']) }})</h6>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="list-group list-group-flush">
                                            @foreach($currentField['options'] as $index => $option)
                                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                                    <div class="d-flex align-items-center">
                                                        <span class="badge bg-secondary me-2">{{ $index + 1 }}</span>
                                                        <span>{{ $option }}</span>
                                                    </div>
                                                    <div class="btn-group btn-group-sm">
                                                        <button type="button" 
                                                                wire:click="moveOptionUp({{ $index }})"
                                                                class="btn btn-outline-secondary"
                                                                {{ $index === 0 ? 'disabled' : '' }}
                                                                title="Move Up">
                                                            <i class="fas fa-arrow-up"></i>
                                                        </button>
                                                        <button type="button" 
                                                                wire:click="moveOptionDown({{ $index }})"
                                                                class="btn btn-outline-secondary"
                                                                {{ $index === count($currentField['options']) - 1 ? 'disabled' : '' }}
                                                                title="Move Down">
                                                            <i class="fas fa-arrow-down"></i>
                                                        </button>
                                                        <button type="button" 
                                                                wire:click="removeOption({{ $index }})"
                                                                class="btn btn-outline-danger"
                                                                title="Remove Option">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @else
                                @if(in_array($currentField['field_type'], ['select', 'radio']))
                                    <div class="alert alert-warning">
                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                        No options added yet. {{ $currentField['field_type'] === 'select' ? 'Select' : 'Radio' }} fields require at least one option.
                                    </div>
                                @elseif($currentField['field_type'] === 'checkbox')
                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle me-2"></i>
                                        No options added. This will create a single checkbox field.
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Form Actions -->
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <div>
                        @if($editingIndex !== null)
                            <span class="text-muted">
                                Editing Field: <strong>{{ $currentField['label'] ?: 'Unnamed Field' }}</strong>
                            </span>
                        @endif
                    </div>
                    
                    <div class="btn-group">
                        @if($editingIndex !== null)
                            <button type="button" 
                                    wire:click="cancelEdit"
                                    class="btn btn-outline-secondary">
                                <i class="fas fa-times me-2"></i>Cancel
                            </button>
                        @endif
                        
                        <button type="submit" 
                                class="btn btn-success"
                                {{ in_array($currentField['field_type'], ['select', 'radio']) && empty($currentField['options']) ? 'disabled' : '' }}>
                            <i class="fas fa-save me-2"></i>
                            {{ $editingIndex === null ? 'Add Field' : 'Update Field' }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Fields List Section -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
            <h2 class="h4 mb-0">
                <i class="fas fa-list me-2"></i>
                Form Fields ({{ count($fields) }})
            </h2>
            @if(count($fields) > 0)
                <button wire:click="saveFormDefinition" 
                        class="btn btn-light btn-sm">
                    <i class="fas fa-save me-1"></i>Save Form
                </button>
            @endif
        </div>
        <div class="card-body">
            @if(count($fields) > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th width="50">#</th>
                                <th>Label</th>
                                <th>Field Name</th>
                                <th>Data Type</th>
                                <th>Field Type</th>
                                <th>Options</th>
                                <th>Required</th>
                                <th width="150">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($fields as $index => $field)
                                <tr class="{{ $editingIndex === $index ? 'table-warning' : '' }}">
                                    <td class="fw-bold">{{ $index + 1 }}</td>
                                    <td>
                                        <strong>{{ $field['label'] ?: 'Unnamed Field' }}</strong>
                                        @if($editingIndex === $index)
                                            <span class="badge bg-warning ms-2">Editing</span>
                                        @endif
                                    </td>
                                    <td><code>{{ $field['name'] }}</code></td>
                                    <td>
                                        <span class="badge bg-secondary">{{ $dataTypes[$field['data_type']] ?? $field['data_type'] }}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-primary">{{ $fieldTypes[$field['field_type']] ?? $field['field_type'] }}</span>
                                    </td>
                                    <td>
                                        @if(in_array($field['field_type'], ['select', 'radio', 'checkbox']) && !empty($field['options']))
                                            @php
                                                $options = is_array($field['options']) ? $field['options'] : array_filter(array_map('trim', explode("\n", $field['options'])));
                                            @endphp
                                            <span class="badge bg-success" title="{{ implode(', ', $options) }}">
                                                {{ count($options) }} options
                                            </span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($field['required'])
                                            <span class="badge bg-danger">Yes</span>
                                        @else
                                            <span class="badge bg-secondary">No</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <button wire:click="editField({{ $index }})" 
                                                    class="btn btn-outline-primary"
                                                    title="Edit Field">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button wire:click="moveFieldUp({{ $index }})" 
                                                    class="btn btn-outline-secondary"
                                                    {{ $index === 0 ? 'disabled' : '' }}
                                                    title="Move Up">
                                                <i class="fas fa-arrow-up"></i>
                                            </button>
                                            <button wire:click="moveFieldDown({{ $index }})" 
                                                    class="btn btn-outline-secondary"
                                                    {{ $index === count($fields) - 1 ? 'disabled' : '' }}
                                                    title="Move Down">
                                                <i class="fas fa-arrow-down"></i>
                                            </button>
                                            <button wire:click="removeField({{ $index }})" 
                                                    class="btn btn-outline-danger"
                                                    title="Remove Field"
                                                    onclick="return confirm('Are you sure you want to remove this field?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                    <h4 class="text-muted">No Fields Added Yet</h4>
                    <p class="text-muted">Start by adding your first field using the form above.</p>
                </div>
            @endif
        </div>
    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" 
                                class="btn btn-success">
                            <i class="fas fa-paper-plane me-2"></i>Submit Form
                        </button>
                    </div>
                </form>
            </div>
        </div>
    
</div>
@push('messcripts')
<!-- Include Bootstrap Icons -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

<script>
    document.addEventListener('livewire:load', function() {
        Livewire.on('scroll-to-top', () => {
            document.getElementById('top-form').scrollIntoView({ 
                behavior: 'smooth' 
            });
        });
    });
</script>
@endpush
@push('messtyles')
<style>
    .table-hover tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.075);
    }
    .btn-group-sm > .btn {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }
    .badge {
        font-size: 0.75em;
    }
    .list-group-item {
        border: none;
        border-bottom: 1px solid #dee2e6;
    }
    .list-group-item:last-child {
        border-bottom: none;
    }
</style>
@endpush