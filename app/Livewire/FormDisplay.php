<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\DynamicForm;
use App\Models\FormSubmission;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class FormDisplay extends Component
{
    use WithFileUploads;

    public $formId;
    public $form;
    public $submissions = [];
    public $showSubmissions = false;
    public $tempFiles = [];

    protected $rules = [];

    public function mount($formId)
    {
        $this->formId = $formId;
        $this->form = DynamicForm::findOrFail($formId);
        
        // Build validation rules dynamically based on form fields
        $this->buildValidationRules();
        
        // Initialize submissions array with empty values
        $this->initializeSubmissions();
    }

    protected function buildValidationRules()
    {
        foreach ($this->form->fields as $field) {
            $rule = [];
            
            if ($field['required']) {
                $rule[] = 'required';
            } else {
                $rule[] = 'nullable';
            }

            // Add type-specific validation rules
            switch ($field['type']) {
                case 'email':
                    $rule[] = 'email';
                    break;
                case 'number':
                    $rule[] = 'numeric';
                    break;
                case 'file':
                    $rule[] = 'file';
                    $rule[] = 'max:10240'; // 10MB max
                    break;
                case 'checkbox':
                    // For checkboxes, we expect an array
                    if ($field['required']) {
                        $rule[] = 'array|min:1';
                    } else {
                        $rule[] = 'nullable';
                    }
                    break;
                case 'radio':
                case 'select':
                    // Validate against available options
                    if (!empty($field['options'])) {
                        $rule[] = 'in:' . implode(',', $field['options']);
                    }
                    break;
                case 'date':
                    $rule[] = 'date';
                    break;
                default:
                    $rule[] = 'string';
                    if ($field['type'] === 'text') {
                        $rule[] = 'max:255';
                    }
                    break;
            }

            $this->rules["submissions.{$field['name']}"] = $rule;
        }
    }

    protected function initializeSubmissions()
    {
        foreach ($this->form->fields as $field) {
            if ($field['type'] === 'checkbox') {
                $this->submissions[$field['name']] = [];
            } else {
                $this->submissions[$field['name']] = '';
            }
        }
    }

    public function submitForm()
    {
        $this->validate();

        try {
            // Process file uploads if any
            $submissionData = $this->processSubmissionData();

            // Save submission to database
            FormSubmission::create([
                'form_id' => $this->formId,
                'data' => $submissionData,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);

            // Clear temporary files
            $this->clearTempFiles();

            session()->flash('message', 'Form submitted successfully! Thank you for your response.');
            
            // Reset form fields
            $this->initializeSubmissions();
            
            // Reset validation
            $this->resetValidation();

        } catch (\Exception $e) {
            session()->flash('error', 'There was an error submitting the form. Please try again.');
            logger()->error('Form submission error: ' . $e->getMessage());
        }
    }

    protected function processSubmissionData()
    {
        $processedData = [];

        foreach ($this->form->fields as $field) {
            $fieldName = $field['name'];
            $fieldValue = $this->submissions[$fieldName] ?? null;

            if ($field['type'] === 'file' && $fieldValue) {
                // Handle file upload
                $filePath = $fieldValue->store('form-submissions/' . $this->formId, 'public');
                $processedData[$fieldName] = [
                    'filename' => $fieldValue->getClientOriginalName(),
                    'path' => $filePath,
                    'mime_type' => $fieldValue->getMimeType(),
                    'size' => $fieldValue->getSize(),
                ];
            } else {
                // Handle other field types
                if (is_array($fieldValue)) {
                    $processedData[$fieldName] = array_filter($fieldValue);
                } else {
                    $processedData[$fieldName] = $fieldValue;
                }
            }
        }
dd($processedData);
        return $processedData;
    }

    protected function clearTempFiles()
    {
        foreach ($this->tempFiles as $filePath) {
            if (Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }
        }
        $this->tempFiles = [];
    }

    public function updatedSubmissions($value, $key)
    {
        // Remove validation errors when user starts typing
        $this->resetValidation($key);
        
        // Handle file uploads specifically
        if (str_contains($key, 'submissions.') && $value instanceof \Livewire\TemporaryUploadedFile) {
            $fieldName = str_replace('submissions.', '', $key);
            $field = collect($this->form->fields)->firstWhere('name', $fieldName);
            
            if ($field && $field['type'] === 'file') {
                // Validate file size and type
                $this->validateOnly($key);
            }
        }
    }

    public function toggleSubmissions()
    {
        $this->showSubmissions = !$this->showSubmissions;
    }

    public function getSubmissionsProperty()
    {
        return FormSubmission::where('form_id', $this->formId)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($submission) {
                // Process submission data for display
                $submission->data = $this->formatSubmissionData($submission->data);
                return $submission;
            });
    }

    protected function formatSubmissionData($data)
    {
        $formattedData = [];
        
        foreach ($this->form->fields as $field) {
            $fieldName = $field['name'];
            $value = $data[$fieldName] ?? null;
            
            if ($field['type'] === 'file' && is_array($value)) {
                $formattedData[$fieldName] = $value['filename'] ?? 'Uploaded file';
            } elseif (is_array($value)) {
                $formattedData[$fieldName] = implode(', ', $value);
            } else {
                $formattedData[$fieldName] = $value ?? 'Not provided';
            }
        }
        
        return $formattedData;
    }

    public function exportSubmissions()
    {
        // Placeholder for CSV export functionality
        // You can implement this based on your needs
        return response()->streamDownload(function () {
            echo $this->generateCsv();
        }, 'submissions-' . $this->form->title . '-' . now()->format('Y-m-d') . '.csv');
    }

    protected function generateCsv()
    {
        $submissions = $this->submissions;
        $output = fopen('php://output', 'w');
        
        // Add headers
        $headers = ['Submission Date', 'IP Address'];
        foreach ($this->form->fields as $field) {
            $headers[] = $field['label'];
        }
        
        fputcsv($output, $headers);
        
        // Add data rows
        foreach ($submissions as $submission) {
            $row = [
                $submission->created_at->format('Y-m-d H:i:s'),
                $submission->ip_address
            ];
            
            foreach ($this->form->fields as $field) {
                $value = $submission->data[$field['name']] ?? '';
                $row[] = is_array($value) ? implode(', ', $value) : $value;
            }
            
            fputcsv($output, $row);
        }
        
        fclose($output);
    }

    public function getSubmissionCountProperty()
    {
        return FormSubmission::where('form_id', $this->formId)->count();
    }

    public function getFormStatsProperty()
    {
        return [
            'total_submissions' => $this->submissionCount,
            'last_submission' => FormSubmission::where('form_id', $this->formId)
                ->orderBy('created_at', 'desc')
                ->first()?->created_at,
            'today_submissions' => FormSubmission::where('form_id', $this->formId)
                ->whereDate('created_at', today())
                ->count(),
        ];
    }

    public function hydrate()
    {
        // Re-initialize form when component hydrates
        if ($this->formId) {
            $this->form = DynamicForm::find($this->formId);
        }
    }

    public function dehydrate()
    {
        // Clean up temporary files when component dehydrates
        $this->clearTempFiles();
    }

    public function render()
    {
        return view('livewire.form-display');
    }
}