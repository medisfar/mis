<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;

class FormPreview extends Component
{
    public $nom;
    public $fields = [];
    public $formData = [];
    public $formTitle = 'Form Preview';
    public $mid=1,$fid=1,$sid,$gid;
    protected $rules = [];

    public function mount($sid,$fid,$mid)
    {
        $this->fid=$fid;
        $this->mid=$mid;
        $this->sid=$sid;
        
     
        $f=\App\Models\Formulaire::find($fid);
        //dd($f,$mid,$sid);
        
        // Load fields from session if they exist
        $storedFields = $f->fields;
        if (!empty($storedFields)) {
            $this->fields = json_decode($storedFields, true);
            // Convert options from string to array for existing fields
            foreach ($this->fields as &$field) {
                if (isset($field['options']) && is_string($field['options'])) {
                    $field['options'] = array_filter(array_map('trim', explode("\n", $field['options'])));
                }
            }
            }
    }

    public function loadFormData()
    {
       $d=\App\Models\MetaDonnee::whereRaw('lessession_id=? and membre_id=?',[$this->sid,$this->mid])->first();
       if($d!=null)
           $this->formData=json_decode($d->donnes,1);
     }

    public function buildValidationRules()
    {
        $rules = [];
        
        foreach ($this->fields as $field) {
            if (!isset($field['name']) || empty($field['name'])) {
                continue;
            }
            
            $fieldRules = [];
            
            if (isset($field['required']) && $field['required']) {
                $fieldRules[] = 'required';
            } else {
                $fieldRules[] = 'nullable';
            }
            
            if (isset($field['data_type'])) {
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
            }
            
            $rules["formData.{$field['name']}"] = implode('|', $fieldRules);
        }
        
        $this->rules = $rules;
    }

    public function updated($propertyName)
    {
        // Rebuild rules when fields change
        if ($propertyName === 'fields') {
            $this->buildValidationRules();
        }
    }

    public function submitForm()
    {
        //$this->validate();
        $d=\App\Models\MetaDonnee::whereRaw('lessession_id=? and membre_id=?',[$this->sid,$this->mid])->first();
        if($d==null)
        $d= new \App\Models\MetaDonnee;
        $d->membre_id=$this->mid;
        $d->lessession_id=$this->sid;
        $d->donnes=json_encode($this->formData);
        $d->save();
        $this->dispatch('hide-modal');
        $this->dispatch('lsidupdated');
        //return redirect()->route('datacollect.lessessions.liste');
        /*
        // Store form data in session
        Session::put("form_data_{$this->nom}", json_encode($this->formData));
        
        session()->flash('message', 'Form submitted successfully!');
        
        // Emit event if needed
        $this->emit('formSubmitted', $this->formData);
        */
    }

    public function clearForm()
    {
        $this->formData = [];
        Session::forget("form_data_{$this->nom}");
        session()->flash('message', 'Form cleared successfully!');
    }

    public function render()
    {
        return view('livewire.form-preview');
    }
    public function add(){
        return redirect()->route('form-saisie',[$this->mid,$this->fid]);
    
    }
}