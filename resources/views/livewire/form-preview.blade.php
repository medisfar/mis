 <x-slot name="titre">Membre: {{App\Models\Membre::find($mid)->nom}}</x-slot>
<div class="card shadow-sm">
     
    <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
        <h2 class="h4 mb-0">
            <i class="fas fa-eye me-2"></i>
            {{ $formTitle }}  {{App\Models\Membre::find($mid)->nom}}
        </h2>
       
        <button wire:click="clearForm" class="btn btn-light btn-sm">
            <i class="fas fa-broom me-1"></i>Clear Form
        </button>
    </div>
    <div class="card-body">
        
        <form wire:submit.prevent="submitForm">
            @foreach($fields as $field)
                @if(isset($field['label']) && isset($field['name']) && !empty($field['label']) && !empty($field['name']))
                    <div class="mb-3">
                        <label class="form-label">
                            {{ $field['label'] }}
                            @if(isset($field['required']) && $field['required']) 
                                <span class="text-danger">*</span> 
                            @endif
                        </label>
                        
                        @if($field['field_type'] === 'textbox')
                            <input type="text" 
                                   wire:model="formData.{{ $field['name'] }}"
                                   placeholder="{{ $field['placeholder'] ?? '' }}"
                                   class="form-control @error('formData.' . $field['name']) is-invalid @enderror"
                                   @if(isset($field['required']) && $field['required']) required @endif>
                        
                        @elseif($field['field_type'] === 'email')
                            <input type="email" 
                                   wire:model="formData.{{ $field['name'] }}"
                                   placeholder="{{ $field['placeholder'] ?? '' }}"
                                   class="form-control @error('formData.' . $field['name']) is-invalid @enderror"
                                   @if(isset($field['required']) && $field['required']) required @endif>
                        
                        @elseif($field['field_type'] === 'date')
                            <input type="date" 
                                   wire:model="formData.{{ $field['name'] }}"
                                   class="form-control @error('formData.' . $field['name']) is-invalid @enderror"
                                   @if(isset($field['required']) && $field['required']) required @endif>
                        
                        @elseif($field['field_type'] === 'number')
                            <input type="number" 
                                   wire:model="formData.{{ $field['name'] }}"
                                   placeholder="{{ $field['placeholder'] ?? '' }}"
                                   class="form-control @error('formData.' . $field['name']) is-invalid @enderror"
                                   @if(isset($field['required']) && $field['required']) required @endif>
                        
                        @elseif($field['field_type'] === 'textarea')
                            <textarea wire:model="formData.{{ $field['name'] }}"
                                      placeholder="{{ $field['placeholder'] ?? '' }}"
                                      class="form-control @error('formData.' . $field['name']) is-invalid @enderror"
                                      rows="3"
                                      @if(isset($field['required']) && $field['required']) required @endif></textarea>
                        
                        @elseif($field['field_type'] === 'checkbox')
                            <div class="form-check">
                                <input type="checkbox" 
                                       wire:model="formData.{{ $field['name'] }}"
                                       class="form-check-input @error('formData.' . $field['name']) is-invalid @enderror"
                                       id="field-{{ $field['name'] }}"
                                       @if(isset($field['required']) && $field['required']) required @endif>
                                <label class="form-check-label" for="field-{{ $field['name'] }}">
                                    {{ $field['placeholder'] ?? 'Check this box' }}
                                </label>
                            </div>
                        
                        @elseif($field['field_type'] === 'radio' && !empty($field['options']))
                            <div>
                                @php
                                    $options = is_array($field['options']) ? $field['options'] : array_filter(array_map('trim', explode("\n", $field['options'])));
                                @endphp
                                @foreach($options as $optionIndex => $option)
                                    <div class="form-check">
                                        <input type="radio" 
                                               wire:model="formData.{{ $field['name'] }}" 
                                               value="{{ $option }}"
                                               class="form-check-input @error('formData.' . $field['name']) is-invalid @enderror"
                                               id="radio-{{ $field['name'] }}-{{ $optionIndex }}"
                                               @if(isset($field['required']) && $field['required']) required @endif>
                                        <label class="form-check-label" for="radio-{{ $field['name'] }}-{{ $optionIndex }}">
                                            {{ $option }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        
                        @elseif($field['field_type'] === 'select' && !empty($field['options']))
                            <select wire:model="formData.{{ $field['name'] }}"
                                    class="form-select @error('formData.' . $field['name']) is-invalid @enderror"
                                    @if(isset($field['required']) && $field['required']) required @endif>
                                <option value="">Select an option</option>
                                @php
                                    $options = is_array($field['options']) ? $field['options'] : array_filter(array_map('trim', explode("\n", $field['options'])));
                                @endphp
                                @foreach($options as $option)
                                    <option value="{{ $option }}">{{ $option }}</option>
                                @endforeach
                            </select>
                        @endif
                        
                        @error('formData.' . $field['name']) 
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                @endif
            @endforeach

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="submit" 
                        class="btn btn-success">
                    <i class="fas fa-paper-plane me-2"></i>Submit Form
                </button>
            </div>
        </form>
    </div>
</div>