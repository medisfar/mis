<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\DynamicForm;

class FormList extends Component
{
    public $forms;

    public function mount()
    {
        $this->loadForms();
    }

    public function loadForms()
    {
        $this->forms = DynamicForm::withCount('submissions')->get();
    }

    public function deleteForm($formId)
    {
        $form = DynamicForm::findOrFail($formId);
        $form->delete();
        
        session()->flash('message', 'Form deleted successfully!');
        $this->loadForms();
    }

    public function duplicateForm($formId)
    {
        $originalForm = DynamicForm::findOrFail($formId);
        
        $newForm = DynamicForm::create([
            'title' => $originalForm->title . ' (Copy)',
            'fields' => $originalForm->fields,
            'user_id' => auth()->id(),
        ]);

        session()->flash('message', 'Form duplicated successfully!');
        $this->loadForms();
    }

    public function getTotalSubmissionsProperty()
    {
        return $this->forms->sum('submissions_count');
    }

    public function getTotalFieldsProperty()
    {
        return $this->forms->sum('fields_count');
    }

    public function getActiveFormsProperty()
    {
        return $this->forms->where('submissions_count', '>', 0)->count();
    }

    public function render()
    {
        return view('livewire.form-list');
    }
}