<?php

namespace App\Livewire;

use Livewire\Attributes\On; 
use Livewire\Component;

class Lamodal extends Component
{
    public bool $show = false;
    public string $title = '';
    public string|array $content = '';
    public string $size = 'modal-lg';
    public array $options = [];
    
    #[On('show-modal')]
    public function show(string $title, string|array $content = '', string $size = 'modal-lg', array $options = [])
    { 
        $this->title = $title;
        $this->content = $content;
        $this->size = $size;
        $this->options = $options;
        $this->show = true;
       
    }

    #[On('hide-modal')]
    public function hide()
    {
        $this->show = false;
    }

    public function render()
    { 
        return view('livewire.lamodal');
    }
}