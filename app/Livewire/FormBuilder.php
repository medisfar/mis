<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request; 

class FormBuilder extends Component
{
    public $nom;
    public $fields = [];
    public $formData = [];
    public $editingIndex = null;
    public $ps,$fid;
    public $currentField = [
        'label' => '',
        'name' => '',
        'data_type' => 'string',
        'field_type' => 'textbox',
        'required' => false,
        'options' => [],
        'placeholder' => '',
    ];

    public $newOption = '';

    public $fieldTypes = [
        'textbox' => 'Text Input',
        'checkbox' => 'Checkbox',
        'radio' => 'Radio Button',
        'select' => 'Dropdown Select',
        'textarea' => 'Text Area',
        'email' => 'Email Input',
        'date' => 'Date Picker',
        'number' => 'Number Input',
    ];
    
    public $dataTypes = [
        'integer' => 'Integer',
        'real' => 'Decimal',
        'date' => 'Date',
        'email' => 'Email',
        'string' => 'Text',
    ];

    protected $rules = [
        'currentField.label' => 'required|string',
        'currentField.name' => 'required|alpha_dash',
        'currentField.data_type' => 'required|in:integer,real,date,email,string',
        'currentField.field_type' => 'required|in:textbox,checkbox,radio,select,textarea,email,date,number',
        'currentField.required' => 'boolean',
        'currentField.placeholder' => 'nullable|string',
        'newOption' => 'nullable|string',
    ];

    public function mount($fid = null)
    {
         $this->fid=$fid;
         if($this->fid){
        $ps=\App\Models\Formulaire::find($this->fid);
        $this->nom = $ps->nom ?? 'default_form';
        
        $storedFields =$ps->fields;
        // Load fields from session if they exist
        //dd([$ps,$storedFields]);

        if (!empty($storedFields)) {
            $this->fields = json_decode($storedFields, true);
            // Convert options from string to array for existing fields
            foreach ($this->fields as &$field) {
                if (isset($field['options']) && is_string($field['options'])) {
                    $field['options'] = array_filter(array_map('trim', explode("\n", $field['options'])));
                }
            }
            }}
            //dd($storedFields);
    }

    public function resetForm()
    {
        $this->currentField = [
            'label' => '',
            'name' => '',
            'data_type' => 'string',
            'field_type' => 'textbox',
            'required' => false,
            'options' => [],
            'placeholder' => '',
        ];
        $this->newOption = '';
        $this->editingIndex = null;
        $this->resetErrorBag();
    }

    public function addOption()
    {
        if (!empty(trim($this->newOption))) {
            $this->currentField['options'][] = trim($this->newOption);
            $this->newOption = '';
        }
    }

    public function removeOption($index)
    {
        if (isset($this->currentField['options'][$index])) {
            unset($this->currentField['options'][$index]);
            $this->currentField['options'] = array_values($this->currentField['options']);
        }
    }

    public function moveOptionUp($index)
    {
        if ($index > 0 && isset($this->currentField['options'][$index])) {
            $temp = $this->currentField['options'][$index - 1];
            $this->currentField['options'][$index - 1] = $this->currentField['options'][$index];
            $this->currentField['options'][$index] = $temp;
        }
    }

    public function moveOptionDown($index)
    {
        if ($index < count($this->currentField['options']) - 1 && isset($this->currentField['options'][$index])) {
            $temp = $this->currentField['options'][$index + 1];
            $this->currentField['options'][$index + 1] = $this->currentField['options'][$index];
            $this->currentField['options'][$index] = $temp;
        }
    }

    public function addField()
    {
        $this->validate();
        
        // Validate that select/radio fields have options, but not checkboxes
        if (in_array($this->currentField['field_type'], ['select', 'radio']) && empty($this->currentField['options'])) {
            session()->flash('error', 'Select and radio fields must have at least one option.');
            return;
        }
        
        $this->fields[] = [
            'label' => $this->currentField['label'],
            'name' => $this->currentField['name'],
            'data_type' => $this->currentField['data_type'],
            'field_type' => $this->currentField['field_type'],
            'required' => (bool) $this->currentField['required'],
            'options' => $this->currentField['options'],
            'placeholder' => $this->currentField['placeholder'],
        ];
          
        $this->resetForm();
        session()->flash('message', 'Field added successfully!');
    }

    public function editField($index)
    {
        $this->editingIndex = $index;
        $this->currentField = $this->fields[$index];
        
        // Ensure options is an array
        if (is_string($this->currentField['options'])) {
            $this->currentField['options'] = array_filter(array_map('trim', explode("\n", $this->currentField['options'])));
        }
        
    }

    public function updateField()
    {
        $this->validate();
        
        // Validate that select/radio fields have options, but not checkboxes
        if (in_array($this->currentField['field_type'], ['select', 'radio']) && empty($this->currentField['options'])) {
            session()->flash('error', 'Select and radio fields must have at least one option.');
            return;
        }
        
        if ($this->editingIndex !== null) {
            $this->fields[$this->editingIndex] = [
                'label' => $this->currentField['label'],
                'name' => $this->currentField['name'],
                'data_type' => $this->currentField['data_type'],
                'field_type' => $this->currentField['field_type'],
                'required' => (bool) $this->currentField['required'],
                'options' => $this->currentField['options'],
                'placeholder' => $this->currentField['placeholder'],
            ];
            
            $this->resetForm();
            session()->flash('message', 'Field updated successfully!');
        }
    }

    public function cancelEdit()
    {
        $this->resetForm();
    }

    public function removeField($index)
    {
        unset($this->fields[$index]);
        $this->fields = array_values($this->fields);
        
        if ($this->editingIndex === $index) {
            $this->resetForm();
        } elseif ($this->editingIndex !== null && $this->editingIndex > $index) {
            $this->editingIndex--;
        }
        
        session()->flash('message', 'Field removed successfully!');
    }

    public function moveFieldUp($index)
    {
        if ($index > 0) {
            $temp = $this->fields[$index - 1];
            $this->fields[$index - 1] = $this->fields[$index];
            $this->fields[$index] = $temp;
            
            if ($this->editingIndex === $index) {
                $this->editingIndex--;
            } elseif ($this->editingIndex === $index - 1) {
                $this->editingIndex++;
            }
        }
    }

    public function moveFieldDown($index)
    {
        if ($index < count($this->fields) - 1) {
            $temp = $this->fields[$index + 1];
            $this->fields[$index + 1] = $this->fields[$index];
            $this->fields[$index] = $temp;
            
            if ($this->editingIndex === $index) {
                $this->editingIndex++;
            } elseif ($this->editingIndex === $index + 1) {
                $this->editingIndex--;
            }
        }
    }

    public function saveFormDefinition()
    {//('up');
        // Convert options array to string for storage
        $fieldsForStorage = $this->fields;
        foreach ($fieldsForStorage as &$field) {
            if (is_array($field['options'])) {
                $field['options'] = implode("\n", $field['options']);
            }
        }
        
        //Session::put("form_builder_{$this->nom}", json_encode($fieldsForStorage));
        //dd([$this->fid,$this->ps,$fieldsForStorage]);
        $this->ps=\App\Models\Formulaire::find($this->fid);
        $this->ps->fields=json_encode($fieldsForStorage);
        $this->ps->save();
        session()->flash('message', 'Form definition saved successfully!');
        $this->dispatch('close-modal');
    }

    public function loadFormData()
    {
        $storedData = Session::get("form_data_{$this->nom}", []);
        if (!empty($storedData)) {
            $this->formData = json_decode($storedData, true);
        }
    }

    public function submitForm()
    {
        $rules = $this->buildValidationRules();
        $this->validate($rules);
        //dd($this->formData);
        //Session::put("form_data_{$this->nom}", json_encode($this->formData));
        //session()->flash('message', 'Form submitted successfully!');
        \App\Models\Formulaire::find($this-fid)->fields=json_encode($this->fields);
    }

    private function buildValidationRules()
    {
        $rules = [];
        
        foreach ($this->fields as $field) {
            $fieldRules = [];
            
            if ($field['required']) {
                $fieldRules[] = 'required';
            } else {
                $fieldRules[] = 'nullable';
            }
            
            switch ($field['data_type']) {
                case 'integer':
                    $fieldRules[] = 'integer';
                    break;
                case 'real':
                    $fieldRules[] = 'numeric';
                    break;
                case 'date':
                    $fieldRules[] = 'date';
                    break;
                case 'email':
                    $fieldRules[] = 'email';
                    break;
                case 'string':
                    $fieldRules[] = 'string';
                    break;
            }
            
            $rules["formData.{$field['name']}"] = implode('|', $fieldRules);
        }
        
        return $rules;
    }

    public function render()
    {
        return view('livewire.form-builder');
    }
}