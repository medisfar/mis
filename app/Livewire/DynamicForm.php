<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Session;
use App\Models\Donnee;
use Illuminate\Support\Facades\Auth;

class DynamicForm extends Component
{
    public $membreId;
    public $classeId;
    public $session;
    public $formData = [];
    public $formStructure = [];
    
    protected $rules = [
        'formData.*' => 'required',
    ];
    
    protected $messages = [
        'formData.*.required' => 'Ce champ est obligatoire.',
    ];

    public function mount($membreId, $classeId)
    {
        $this->membreId = $membreId;
        $this->classeId = $classeId;
        
        // Charger la session avec le formulaire JSON
        $this->session = Session::findOrFail($classeId);
        $this->formStructure = json_decode($this->session->json_form, true);
        
        // Charger les données existantes si elles existent
        $existingData = Donnee::where('membre_id', $membreId)
                            ->where('session_id', $classeId)
                            ->first();
                            
        if ($existingData) {
            $this->formData = json_decode($existingData->form_data, true);
        }
    }

    public function render()
    {
        return view('livewire.dynamic-form');
    }

    public function submit()
    {
        $this->validate();
        
        // Enregistrer ou mettre à jour les données
        Donnee::updateOrCreate(
            [
                'membre_id' => $this->membreId,
                'session_id' => $this->classeId,
            ],
            [
                'form_data' => json_encode($this->formData),
                'date_session' => now(),
            ]
        );
        
        session()->flash('message', 'Données enregistrées avec succès!');
    }
}