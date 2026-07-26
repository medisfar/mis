<div>
    <h2 class="text-xl font-semibold mb-4">{{ $session->nom }}</h2>
    
    @if(session('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif
    
    <form wire:submit.prevent="submit">
        @foreach($formStructure as $field)
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="field-{{ $field['name'] }}">
                    {{ $field['label'] }}
                    @if(isset($field['required']) && $field['required'])
                        <span class="text-red-500">*</span>
                    @endif
                </label>
                
                @if($field['type'] === 'text' || $field['type'] === 'email' || $field['type'] === 'number')
                    <input 
                        type="{{ $field['type'] }}" 
                        id="field-{{ $field['name'] }}"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        wire:model="formData.{{ $field['name'] }}"
                        @if(isset($field['required']) && $field['required']) required @endif
                    >
                
                @elseif($field['type'] === 'textarea')
                    <textarea 
                        id="field-{{ $field['name'] }}"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        wire:model="formData.{{ $field['name'] }}"
                        @if(isset($field['required']) && $field['required']) required @endif
                    ></textarea>
                
                @elseif($field['type'] === 'select')
                    <select 
                        id="field-{{ $field['name'] }}"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        wire:model="formData.{{ $field['name'] }}"
                        @if(isset($field['required']) && $field['required']) required @endif
                    >
                        <option value="">-- Sélectionner --</option>
                        @foreach($field['options'] as $option)
                            <option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
                        @endforeach
                    </select>
                
                @elseif($field['type'] === 'checkbox')
                    <div>
                        @foreach($field['options'] as $option)
                            <label class="inline-flex items-center mt-2 mr-4">
                                <input 
                                    type="checkbox" 
                                    value="{{ $option['value'] }}"
                                    wire:model="formData.{{ $field['name'] }}"
                                    class="form-checkbox h-5 w-5 text-blue-600"
                                >
                                <span class="ml-2">{{ $option['label'] }}</span>
                            </label>
                        @endforeach
                    </div>
                
                @elseif($field['type'] === 'radio')
                    <div>
                        @foreach($field['options'] as $option)
                            <label class="inline-flex items-center mt-2 mr-4">
                                <input 
                                    type="radio" 
                                    value="{{ $option['value'] }}"
                                    wire:model="formData.{{ $field['name'] }}"
                                    class="form-radio h-5 w-5 text-blue-600"
                                    @if(isset($field['required']) && $field['required']) required @endif
                                >
                                <span class="ml-2">{{ $option['label'] }}</span>
                            </label>
                        @endforeach
                    </div>
                @endif
                
                @error('formData.' . $field['name'])
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
        @endforeach
        
        <div class="flex items-center justify-between">
            <button 
                type="submit" 
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
            >
                Enregistrer
            </button>
        </div>
    </form>
</div>